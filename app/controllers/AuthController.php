<?php
class AuthController extends Controller
{
    public function login()
    {
        // If already logged in, redirect to home
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/home/index'); // Or admin/index depending on role
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
                    // Login success
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['email'] = $user['email'];
                    // Add avatar if exists
                    
                    // $_SESSION['success'] = "Đăng nhập thành công";
                    
                    if ($user['role'] == 'admin') {
                        $this->redirect('/category'); // Or dashboard
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
                 
                 // Check email exists
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

    public function logout()
    {
        session_unset();
        session_destroy();
        session_start(); 
        $this->redirect('/auth/login');
    }
}
