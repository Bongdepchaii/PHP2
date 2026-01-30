<?php
class HomeController extends Controller
{
    public function index()
    {
        $productModel = $this->model('product');
        $categoryModel = $this->model('category');
        $trademarkModel = $this->model('trademark');
        
        $products = $productModel->all();
        $categories = $categoryModel->all();
        $trademarks = $trademarkModel->all();
        
        $title = "Trang chủ";
        $this->view("home/index", [
            'title' => $title,
            'products' => $products,
            'categories' => $categories
        ]);
    }
}