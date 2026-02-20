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

    public function favorite(){
        if(!isset($_SESSION['user_id'])){
            $this->redirect('/auth/login');
        } else {
            $favoriteModel = $this->model('favorite');
            $favorites = $favoriteModel->getFavoritesByUserId($_SESSION['user_id']);
            $title = "Sản phẩm yêu thích";
            $this->view("users/favorite", [
                'title' => $title,
                'favorites' => $favorites
            ]);
        }
    } 

    public function deleteFavorite($id)
    {
        $favoriteModel = $this->model('favorite');
        $favoriteModel->delete($id);
        $_SESSION['success'] = "Đã xóa khỏi danh sách yêu thích";
        $this->redirect('/user/favorite');
    }

    public function addFavorite($id)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $favoriteModel = $this->model('favorite');
        
        // Check if already exists
        if (!$favoriteModel->checkFavorite($userId, $id)) {
            $favoriteModel->create([
                'id_product' => $id,
                'id_user' => $userId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $_SESSION['success'] = "Đã thêm vào danh sách yêu thích";
        } else {
            $_SESSION['error'] = "Sản phẩm đã có trong danh sách yêu thích";
        }
        
        // Redirect back to previous page
        if(isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('/');
        }
    }
}