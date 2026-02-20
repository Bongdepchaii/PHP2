<?php

class ContactController extends Controller
{
    public function index()
    {
        $contact = $this->model('contact');
        $data = $contact->all();
        $title = "Message";
        $this->view("contact/index", [
            'title' => $title,
            'contact' => $data
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $subject = trim($_POST['subject']);
            $message = trim($_POST['message']);
            $user_id = trim($_SESSION['user_id']);
            $checkbox = $_POST['newsletter'];

            if (empty($name) && empty($email) && empty($phone) && empty($subject) && empty($message)) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin form liên hệ";
            } else if ( !isset($checkbox)){
                $_SESSION['message'] = "Vui lòng tích xác nhận gửi form liên hệ của chúng tôi";
            } else {
                 $contact = $this->model('contact');
                $contact->create(array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message,
                    'user_id' => $user_id,
                ));
                 $_SESSION['success'] = "Chúng tôi đã thêm thông tin liên hệ của bạn";
            }
        }
        $this->redirect('/contact');
    }
    // ===========================
    // ADMIN METHODS
    // ===========================
    
    public function admin()
    {
        $contactModel = $this->model('contact');
        $contacts = $contactModel->all();
        
        $this->view('contact.admin', [
            'contacts' => $contacts,
            'title' => 'Quản lý liên hệ'
        ]);
    }

    public function delete($id)
    {
        $contactModel = $this->model('contact');
        $result = $contactModel->delete($id);
        
        if ($result) {
            $_SESSION['success'] = "Xóa liên hệ thành công";
        } else {
            $_SESSION['error'] = "Xóa liên hệ thất bại";
        }
        
        $this->redirect('/contact/admin');
    }
}
