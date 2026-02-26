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
        $page        = max(1, (int)($_GET['page'] ?? 1));
        $perPage     = 9;

        if ($keyword) {
            $products = $productModel->search($keyword, $page, $perPage);
            $total    = $productModel->countSearch($keyword);
        } elseif ($categoryId && $trademarkId) {
            $all      = $productModel->findByCategoryAndTrademark($categoryId, $trademarkId);
            $total    = count($all);
            $products = array_slice($all, ($page - 1) * $perPage, $perPage);
        } elseif ($categoryId) {
            $all      = $productModel->findByCategory($categoryId);
            $total    = count($all);
            $products = array_slice($all, ($page - 1) * $perPage, $perPage);
        } elseif ($trademarkId) {
            $all      = $productModel->findByTrademark($trademarkId);
            $total    = count($all);
            $products = array_slice($all, ($page - 1) * $perPage, $perPage);
        } else {
            $all      = $productModel->all();
            $total    = count($all);
            $products = array_slice($all, ($page - 1) * $perPage, $perPage);
        }

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
            'page'              => $page,
            'perPage'           => $perPage,
            'total'             => $total,
            'totalPage'         => $totalPage,
        ]);
    }
}