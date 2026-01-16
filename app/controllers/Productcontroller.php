<?php
class Productcontroller extends Controller
{
    public function index()
    {
        $product = $this->model('product'); //
        // $product = new Product();
        $data = $product->all();
        // var_dump($data);
        $title = "Quản lý sản phẩm";
        $this->view("products/index", [
            'title' => $title,
            'products' => $data,
        ]);
    }
}