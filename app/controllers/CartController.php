<?php
class CartController extends Controller
{
    public function index()
    {
        $cart = $this->model('cart'); //
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