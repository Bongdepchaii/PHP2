<?php
class CartController extends Controller
{
    public function index()
    {
        $cart = $this->model('product'); //
        // $product = new Product();
        $data = $cart->all();
        // var_dump($data);
        $title = "Đăng nhập";
        $this->view("cart/index", [
            'title' => $title,
            'cart' => $data,
        ]);
    }
}