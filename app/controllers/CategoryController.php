<?php
class HomeController extends Controller
{
    public function index()
    {
        $category = $this->model('category'); //
        // $product = new Product();
        $data = $category->all();
        // var_dump($data);
        $title = "trang chu";
        $this->view("home/index", [
            'title' => $title,
            'category' => $data,
        ]);
    }
}