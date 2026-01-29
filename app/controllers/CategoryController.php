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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            var_dump($_POST);
            var_dump($name);

            if (!empty($name)) {
                $colorModel = $this->model('category');
                $colorModel->create(array(
                    'name' => $name
                ));
                $this->redirect('/category');
            }
        }
        $this->redirect('/category');
    }

    public function update($id)
    {
        $color = $this->model('category');
        $data = $color->find($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->view("category/edit", [
                'category' => $data
            ]);
        } else {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $colorModel = $this->model('category');
                $isSuccess = $colorModel->update(
                    array(
                        'name' => $name,
                    ),
                    $id
                );
                if ($isSuccess) {
                    $_SESSION['success'] = "Cập nhật thành công";
                }
                $this->redirect('/category');
            }
        }
    }

    public function delete($id){
        $category = $this->model('category');
        $category->delete($id);
        header("Location: /category/index");
    }
}