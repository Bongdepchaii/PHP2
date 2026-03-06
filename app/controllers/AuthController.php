<?php

use MailService\MailService;

class AuthController extends Controller
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home/index');  
        }

        $title = "Đăng nhập";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ email và mật khẩu";
            } else {
                $userModel = $this->model('user');
                $user = $userModel->findByEmail($email);
                
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['email'] = $user['email'];
                    
                    // $_SESSION['success'] = "Đăng nhập thành công";
                    
                    if ($user['role'] == 'admin') {
                        $this->redirect('/booking');
                    } else {
                        $this->redirect('/home/index');
                    }
                } else {
                    $_SESSION['error'] = "Email hoặc mật khẩu không chính xác";
                }
            }
        }

        $this->view("users/login", [
            'title' => $title
        ]);
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home/index');
        }

        $title = "Đăng ký tài khoản";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

             if (empty($username) || empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
            } elseif ($password !== $confirm_password) {
                $_SESSION['error'] = "Mật khẩu nhập lại không khớp";
            } else {
                 $userModel = $this->model('user');
                 
                 $existingUser = $userModel->findByEmail($email);
                 if ($existingUser) {
                     $_SESSION['error'] = "Email này đã được sử dụng";
                 } else {
                     // Create user
                     $userModel->create([
                        'username' => $username, 
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'email' => $email,
                        'name' => $name,
                        'sex' => 'Other', 
                        'age' => 0,       
                        'address' => '',
                        'role' => 'user',
                        'created_at' => date('Y-m-d H:i:s')
                     ]);
                     
                     $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập";
                     $this->redirect('/users/login');
                 }
            }
        }

        $this->view("users/register", [
            'title' => $title
        ]);
    }

    public function profile()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
        }

        $userModel = $this->model('user');
        $user = $userModel->find($_SESSION['user_id']);

        if (!$user) {
            session_unset();
            session_destroy();
            $this->redirect('/auth/login');
        }

        $title = "Hồ sơ cá nhân";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']); 
            $age = trim($_POST['age']);
            $sex = trim($_POST['sex']);
            // $address = trim($_POST['address']);
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : ''; 

            if (empty($name) || empty($email)) {
                $_SESSION['error'] = "Tên và Email không được để trống";
            } else {
                 $data = [
                    'name' => $name,
                    'email' => $email, 
                    'age' => $age,
                    'sex' => $sex,
                    // 'address' => $address,
                    // 'phone' => $phone 
                ];

                $userModel->update($data, $_SESSION['user_id']);
                $_SESSION['success'] = "Cập nhật hồ sơ thành công";
                $_SESSION['user_name'] = $name;  
                $user = $userModel->find($_SESSION['user_id']); 
            }
        }

        $this->view("users/profile", [
            'title'     => $title,
            'user'      => $user,
            'addresses' => $this->model('address')->getByUserId($_SESSION['user_id']),
            'orders'    => $this->model('order')->getByUser($_SESSION['user_id']),
        ]);
    }

    public function logout()
    {
        // Chỉ xóa các session key liên quan đến tài khoản user
        // Giữ lại các session khác như recently_viewed (thuộc về trình duyệt)
        $keepKeys = ['recently_viewed'];
        $kept = [];
        foreach ($keepKeys as $key) {
            if (isset($_SESSION[$key])) {
                $kept[$key] = $_SESSION[$key];
            }
        }

        // Hủy toàn bộ session
        session_unset();
        session_destroy();

        // Khởi động session mới và khôi phục các key cần giữ
        session_start();
        foreach ($kept as $key => $value) {
            $_SESSION[$key] = $value;
        }
        $_SESSION['success'] = "Đăng xuất thành công";
        $this->redirect('/');
    }

    // ========================
    // QUÊN MẬT KHẨU - OTP
    // ========================

    public function forgot()
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home/index');
        }
        $this->view('users/forgot', []);
    }

    // send otp
    public function sendOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/auth/forgot');
        }

        $email = trim($_POST['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['forgot_error'] = 'Vui lòng nhập email hợp lệ.';
            $this->redirect('/auth/forgot');
        }

        $userModel = $this->model('user');
        $user = $userModel->findByEmail($email);

        if (!$user) {
            $_SESSION['forgot_error'] = 'Email không tồn tại trong hệ thống.';
            $this->redirect('/auth/forgot');
        }

        // tao ma otp 6 so radom
        $otp = random_int(100000, 999999);
        // end_otp kieu TIME → het han 5 p
        $expiry = date('H:i:s', strtotime('+5 minutes'));

        // luu otp vao database
        $userModel->saveOtp($email, $otp, $expiry);

        // luu email vao session de hien thi o trang OTP
        $_SESSION['otp_email'] = $email;

        // gui mail
        $subject = 'Mã OTP đặt lại mật khẩu - TBS Shop';
        $content = '
            <div style="font-family: Arial, sans-serif; max-width: 500px; margin: auto; padding: 30px; background: #f9f9f9; border-radius: 10px;">
                <h2 style="color: #667eea; text-align:center;">Đặt lại mật khẩu</h2>
                <p>Xin chào <strong>' . htmlspecialchars($user['name']) . '</strong>,</p>
                <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
                <div style="text-align:center; margin: 25px 0;">
                    <span style="font-size: 2.5rem; font-weight: bold; letter-spacing: 10px; color: #764ba2; background: #ede9ff; padding: 15px 25px; border-radius: 12px; display: inline-block;">' . $otp . '</span>
                </div>
                <p style="text-align:center; color: #888; font-size: 0.9rem;">Mã có hiệu lực trong <strong>5 phút</strong>.</p>
                <p style="color: #e74c3c; font-size: 0.85rem;">Nếu bạn không yêu cầu điều này, hãy bỏ qua email này.</p>
            </div>';

        $fromEmail = 'buitrongthanh2k5@gmail.com';
        $mailSent = MailService::send($email, $fromEmail, $subject, $content);

        if ($mailSent) {
            $_SESSION['forgot_success'] = "Mã OTP đã được gửi đến {$email}. Vui lòng kiểm tra hộp thư.";
            $_SESSION['otp_sent'] = true;
        } else {
            $_SESSION['forgot_error'] = 'Không thể gửi email. Vui lòng thử lại sau.';
        }

        $this->redirect('/auth/forgot');
    }

    // xac nhan otp
    public function verifyOtp()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/auth/forgot');
        }

        $otp = trim($_POST['otp'] ?? '');

        if (empty($otp) || strlen($otp) !== 6) {
            $_SESSION['forgot_error'] = 'Vui lòng nhập đủ 6 chữ số OTP.';
            $_SESSION['otp_sent'] = true;
            $this->redirect('/auth/forgot');
        }

        $userModel = $this->model('user');
        $user = $userModel->findByOtp($otp);

        if (!$user) {
            $_SESSION['forgot_error'] = 'Mã OTP không đúng.';
            $_SESSION['otp_sent'] = true;
            $this->redirect('/auth/forgot');
        }

        // kiem tra het han
        $now     = date('H:i:s');
        $endOtp  = $user['end_otp'];
        if ($now > $endOtp) {
            $_SESSION['forgot_error'] = 'Mã OTP đã hết hạn. Vui lòng yêu cầu mã mới.';
            $userModel->clearOtp($user['id']);
            $this->redirect('/auth/forgot');
        }

        // OTP hop le → luu user_id vao session, xoa OTP
        $_SESSION['reset_user_id'] = $user['id'];
        $userModel->clearOtp($user['id']);
        $_SESSION['otp_verified'] = true;
        $_SESSION['otp_email']    = null;

        $this->redirect('/auth/forgot');
    }

    // cap nhat mat khau
    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/auth/forgot');
        }

        if (!isset($_SESSION['reset_user_id'])) {
            $_SESSION['forgot_error'] = 'Phiên đặt lại mật khẩu đã hết hạn. Vui lòng thử lại.';
            $this->redirect('/auth/forgot');
        }

        $newPassword     = trim($_POST['new_password'] ?? '');
        $confirmPassword = trim($_POST['confirm_password'] ?? '');

        if (empty($newPassword) || strlen($newPassword) < 6) {
            $_SESSION['forgot_error'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
            $_SESSION['otp_verified'] = true;
            $this->redirect('/auth/forgot');
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['forgot_error'] = 'Mật khẩu xác nhận không khớp.';
            $_SESSION['otp_verified'] = true;
            $this->redirect('/auth/forgot');
        }

        $userModel = $this->model('user');
        $userId    = $_SESSION['reset_user_id'];

        $userModel->update([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ], $userId);

        // xoa session reset
        unset($_SESSION['reset_user_id']);
        unset($_SESSION['otp_verified']);
        unset($_SESSION['otp_email']);

        $_SESSION['success'] = 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập.';
        $this->redirect('/auth/login');
    }

    // LOGIN GOOGLE
    public function googleLogin()
    {
        $client = new Google\Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URL']);
        $client->addScope("email");
        $client->addScope("profile");

        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit;
    }

    public function googleCallback()
    {
        $client = new Google\Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URL']);

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['error'])) {
                $_SESSION['error'] = "Không thể đăng nhập bằng Google.";
                $this->redirect('/auth/login');
                return;
            }
            $client->setAccessToken($token);

            $googleService = new Google\Service\Oauth2($client);
            $googleUser = $googleService->userinfo->get();

            $email = $googleUser->email;
            $name = $googleUser->name;
            $googleId = $googleUser->id;

            $userModel = $this->model('user');
            $user = $userModel->findByGoogleId($googleId);

            if (!$user) {
                // Kiểm tra xem email đã tồn tại chưa
                $user = $userModel->findByEmail($email);
                if ($user) {
                    // Liên kết google_id vào user có sẵn
                    $userModel->update(['google_id' => $googleId], $user['id']);
                } else {
                    // Tạo user mới
                    $userModel->create([
                        'username' => $email,
                        'password' => '',
                        'email'    => $email,
                        'name'     => $name,
                        'sex'      => 'Other',
                        'age'      => 0,
                        'address'  => '',
                        'role'     => 'user',
                        'google_id'=> $googleId,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $user = $userModel->findByGoogleId($googleId);
                }
            }

            // Đăng nhập session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['email']     = $user['email'];

            if ($user['role'] == 'admin') {
                $this->redirect('/dashboard');
            } else {
                $this->redirect('/home/index');
            }
        } else {
            $this->redirect('/auth/login');
        }
    }
}
