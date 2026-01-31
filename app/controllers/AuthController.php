<?php
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
                        $this->redirect('/category');
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
            $address = trim($_POST['address']);
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : ''; 

            if (empty($name) || empty($email)) {
                $_SESSION['error'] = "Tên và Email không được để trống";
            } else {
                 $data = [
                    'name' => $name,
                    'email' => $email, 
                    'age' => $age,
                    'sex' => $sex,
                    'address' => $address,
                    // 'phone' => $phone 
                ];

                if (!empty($_POST['new_password'])) {
                    if ($_POST['new_password'] === $_POST['confirm_new_password']) {
                         $data['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    } else {
                         $_SESSION['error'] = "Mật khẩu mới không khớp";
                         $this->view("users/profile", ['title' => $title, 'user' => $user]); 
                         return;
                    }
                }

                $userModel->update($data, $_SESSION['user_id']);
                $_SESSION['success'] = "Cập nhật hồ sơ thành công";
                $_SESSION['user_name'] = $name;  
                $user = $userModel->find($_SESSION['user_id']); 
            }
        }

        $this->view("users/profile", [
            'title' => $title,
            'user' => $user
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
