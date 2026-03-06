<?php

use MailService\MailService;

class ContactController extends Controller
{

    // USER
    public function index()
    {
        $this->view('contact/index', [
            'title' => 'Liên hệ với chúng tôi',
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/contact');
            return;
        }

        $full_name = trim($_POST['full_name'] ?? '');
        $email     = trim($_POST['email']     ?? '');
        $phone     = trim($_POST['phone']     ?? '');
        $subject   = trim($_POST['subject']   ?? '');
        $message   = trim($_POST['message']   ?? '');

        // Validate
        $errors = [];
        if (empty($full_name))                          $errors[] = "Vui lòng nhập họ tên.";
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors[] = "Email không hợp lệ.";
        if (empty($phone))                              $errors[] = "Vui lòng nhập số điện thoại.";
        if (!preg_match('/^[0-9\+\-\s]{7,15}$/', $phone)) $errors[] = "Số điện thoại không hợp lệ.";
        if (empty($subject))                            $errors[] = "Vui lòng chọn chủ đề.";
        if (empty($message))                            $errors[] = "Vui lòng nhập nội dung tin nhắn.";
        if (strlen($message) < 10)                      $errors[] = "Nội dung quá ngắn (tối thiểu 10 ký tự).";

        if (!empty($errors)) {
            $_SESSION['contact_errors'] = $errors;
            $_SESSION['contact_old']    = compact('full_name', 'email', 'phone', 'subject', 'message');
            $this->redirect('/contact');
            return;
        }

        $contactModel = $this->model('contact');
        $contactModel->create(compact('full_name', 'email', 'phone', 'subject', 'message'));

        // thong bao thanh cong cung voi sent mail sang admin
        $this->notifyAdmins($contactModel, $full_name, $email, $phone, $subject, $message);

        $_SESSION['success'] = "Cảm ơn {$full_name}! Chúng tôi đã nhận được tin nhắn và sẽ phản hồi sớm nhất.";
        $this->redirect('/contact');
    }

    /**
     * sent mail tai khoan admin
     */
    private function notifyAdmins($contactModel, $full_name, $email, $phone, $subject, $message)
    {
        $adminEmails = $contactModel->getAdminEmails();
        if (empty($adminEmails)) return;

        $mailSubject = "Liên hệ mới: {$subject}";
        $mailBody    = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; background-color: #fcfcfc;'>
          <h3 style='color: #0d6efd; text-align: center; border-bottom: 2px solid #0d6efd; padding-bottom: 10px;'>THÔNG BÁO: LIÊN HỆ MỚI</h3>
          <p>Chào Ban quản trị, bạn có yêu cầu liên hệ mới từ khách hàng qua website TBS Shop.</p>
          <div style='background: #fff; padding: 15px; border-radius: 8px; border: 1px solid #ddd;'>
            <p><b>Khách hàng:</b> {$full_name}</p>
            <p><b>Email:</b> <a href='mailto:{$email}'>{$email}</a></p>
            <p><b>Điện thoại:</b> {$phone}</p>
            <p><b>Chủ đề:</b> {$subject}</p>
            <p><b>Nội dung tin nhắn:</b></p>
            <div style='background: #f8f9fa; padding: 12px; border-left: 4px solid #0d6efd;'>
                " . nl2br(htmlspecialchars($message)) . "
            </div>
          </div>
          <p style='color:#888; font-size:12px; margin-top:20px; text-align:center;'>Đây là email tự động, vui lòng không trả lời trực tiếp vào email này.</p>
        </div>";

        // gui qua mail service da co san trong file vendor/Mailservice.php
        foreach ($adminEmails as $adminEmail) {
            MailService::send($adminEmail, 'buitrongthanh2k5@gmail.com', $mailSubject, $mailBody);
        }
    }

    // ADMIN
    public function admin()
    {
        $contactModel = $this->model('contact');
        $keyword      = trim($_GET['q']    ?? '');
        $page         = max(1, (int)($_GET['page'] ?? 1));
        $perPage      = 10;

        $contacts  = $contactModel->search($keyword, $page, $perPage);
        $total     = $contactModel->countSearch($keyword);
        $totalPage = (int)ceil($total / $perPage);

        $this->view('contact/admin', [
            'title'     => 'Quản lý liên hệ',
            'contacts'  => $contacts,
            'keyword'   => $keyword,
            'page'      => $page,
            'perPage'   => $perPage,
            'total'     => $total,
            'totalPage' => $totalPage,
        ]);
    }

    public function delete($id)
    {
        if (!$_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn chưa đăng nhập";
            $this->redirect('/auth/login');
            return;
        }
        $result = $this->model('contact')->delete($id);
        $_SESSION[$result ? 'success' : 'error'] = $result
            ? "Đã xóa liên hệ #$id"
            : "Xóa liên hệ thất bại";

        $from = $_GET['from_page'] ?? '';
        $kw   = $_GET['q'] ?? '';
        $qs   = http_build_query(array_filter(['page' => $from, 'q' => $kw]));
        $this->redirect('/contact/admin' . ($qs ? '?' . $qs : ''));
    }
}
