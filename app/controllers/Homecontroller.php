<?php
class HomeController extends Controller
{
    public function index()
    {
        $product = $this->model('product'); //
        // $product = new Product();
        $data = $product->all();
        // var_dump($data);
        $title = "Trang chủ";
        $this->view("home/index.blade", [
            'title' => $title,
            'products' => $data,
        ]);
    }
}