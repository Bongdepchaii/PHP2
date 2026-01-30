<?php
class UserController extends Controller
{
    public function index()
    {
        $user = $this->model('user'); //
        // $product = new Product();
        $data = $user->all();
        // var_dump($data);
        $title = "Quản lý người dùng";
        $this->view("users/index", [
            'title' => $title,
            'user' => $data,
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $age = trim($_POST['age']);
            $sex = trim($_POST['sex']);
            $address = trim($_POST['address']);
            $role = trim($_POST['role']);

            if (!empty($username) && !empty($password) && !empty($name)) {
                $userModel = $this->model('user');
                $userModel->create([
                    'username' => $username,
                    'password' => $password,
                    'name' => $name,
                    'email' => $email,
                    'age' => $age,
                    'sex' => $sex,
                    'address' => $address,
                    'role' => $role,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                $_SESSION['success'] = "Thêm người dùng thành công";
            }
        }
        $this->redirect('/user');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $age = trim($_POST['age']);
            $sex = trim($_POST['sex']);
            $address = trim($_POST['address']);
            $role = trim($_POST['role']);
            
            $data = [
                'username' => $username,
                'name' => $name,
                'email' => $email,
                'age' => $age,
                'sex' => $sex,
                'address' => $address,
                'role' => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
            }

            if (!empty($username) && !empty($name)) {
                $userModel = $this->model('user');
                $userModel->update($data, $id);
                $_SESSION['success'] = "Cập nhật thành công";
            }
        }
        $this->redirect('/user');
    }

    public function delete($id) {
        $user = $this->model('user');
        $user->delete($id);
        $this->redirect('/user');
    }
}