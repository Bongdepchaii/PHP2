<?php
class HomeController extends Controller
{
    public function index()
    {
        $productModel = $this->model('product');
        $categoryModel = $this->model('category');
        
        $products = $productModel->all();
        $categories = $categoryModel->all();
        
        $title = "Trang chủ";
        $this->view("home/index", [
            'title' => $title,
            'products' => $products,
            'categories' => $categories
        ]);
    }
}