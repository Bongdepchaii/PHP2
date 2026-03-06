<?php
class CategoryController extends Controller
{
    public function index()
    {
        $category = $this->model('category'); //
        // $product = new Product();
        $data = $category->all();
        // var_dump($data);
        $title = "Quản lý danh mục";
        $this->view("categorys/index", [
            'title' => $title,
            'category' => $data,
        ]);
    }

    public function add()
    {
        if (!$_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn chưa đăng nhập";
            $this->redirect('/auth/login');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $categoryModel = $this->model('category');
                $categoryModel->create(array(
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s')
                ));
                $_SESSION['success'] = "Thêm danh mục thành công";
            }
        }
        $this->redirect('/category');
    }

    public function update($id)
    {
        if (!$_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn chưa đăng nhập";
            $this->redirect('/auth/login');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $categoryModel = $this->model('category');
                $isSuccess = $categoryModel->update(
                    array(
                        'name' => $name,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "Cập nhật thành công";
                }
            }
        }
        $this->redirect('/category');
    }

    public function delete($id)
    {
        if (!$_SESSION['user_id']) {
            $_SESSION['error'] = "Bạn chưa đăng nhập";
            $this->redirect('/auth/login');
            return;
        }
        $category = $this->model('category');
        $category->delete($id);
        $_SESSION['error'] = "Xóa danh mục thành công";
        $this->redirect('/category');
    }
}
