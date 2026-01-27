<?php
class HomeController extends Controller
{
    public function index()
    {
        $products = $this->model('product'); //
        // $product = new Product();
        $data = $products->all();
        // var_dump($data);
        $title = "Trang chủ";
        $this->view("home/index", [
            'title' => $title,
            'category' => $data,
        ]);
    }
}