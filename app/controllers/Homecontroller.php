<?php
class HomeController extends Controller
{
    public function index()
    {
        $productModel = $this->model('product');
        $categoryModel = $this->model('category');
        $trademarkModel = $this->model('trademark');
        
        // Check for category and trademark filter
        $categoryId = isset($_GET['id_category']) ? $_GET['id_category'] : null;
        $trademarkId = isset($_GET['id_trademark']) ? $_GET['id_trademark'] : null;
        
        if ($categoryId && $trademarkId) {
            $products = $productModel->findByCategoryAndTrademark($categoryId, $trademarkId);
        } else if ($categoryId) {
            $products = $productModel->findByCategory($categoryId);
        } else if ($trademarkId){
            $products = $productModel->findByTrademark($trademarkId);
        } else {
            $products = $productModel->all();
        }

        $categories = $categoryModel->all();
        $trademarks = $trademarkModel->all();
        
        $title = "Trang chủ";
        $this->view("home/index", [
            'title' => $title,
            'products' => $products,
            'categories' => $categories,
            'trademarks' => $trademarks,
            'selectedCategory' => $categoryId, 
            'selectedTrademark' => $trademarkId
        ]);
    }
}