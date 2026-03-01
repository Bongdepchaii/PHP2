<?php
class HomeController extends Controller
{
    public function index()
    {
        $productModel   = $this->model('product');
        $categoryModel  = $this->model('category');
        $trademarkModel = $this->model('trademark');

        $keyword     = trim($_GET['q']    ?? '');
        $categoryId  = $_GET['id_category']  ?? null;
        $trademarkId = $_GET['id_trademark'] ?? null;
        $minPrice    = $_GET['min_price'] ?? null;
        $maxPrice    = $_GET['max_price'] ?? null;
        $page        = max(1, (int)($_GET['page'] ?? 1));
        $perPage     = 9;

        // Xử lý chung bằng hàm filter của product model
        $filterResult = $productModel->filter($categoryId, $trademarkId, $keyword, $minPrice, $maxPrice, $page, $perPage);
        $products = $filterResult['products'];
        $total    = $filterResult['total'];

        $totalPage  = (int)ceil($total / $perPage);
        $categories = $categoryModel->all();
        $trademarks = $trademarkModel->all();

        $this->view("home/index", [
            'title'             => 'Trang chủ',
            'products'          => $products,
            'categories'        => $categories,
            'trademarks'        => $trademarks,
            'selectedCategory'  => $categoryId,
            'selectedTrademark' => $trademarkId,
            'keyword'           => $keyword,
            'minPrice'          => $minPrice,
            'maxPrice'          => $maxPrice,
            'page'              => $page,
            'perPage'           => $perPage,
            'total'             => $total,
            'totalPage'         => $totalPage,
        ]);
    }
}