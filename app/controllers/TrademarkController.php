<?php
class CategoryController extends Controller
{
    public function index()
    {
        $category = $this->model('trademark'); //
        // $product = new Product();
        $data = $category->all();
        // var_dump($data);
        $title = "Quản lý thương hiệu";
        $this->view("trademarks/index", [
            'title' => $title,
            'trademark' => $data,
        ]);
    }
}