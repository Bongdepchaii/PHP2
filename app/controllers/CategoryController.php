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

    public function delete($id){
        $category = $this->model('category');
        $category->delete($id);
        header("Location: /category/index");
    }
}