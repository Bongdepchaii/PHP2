<?php
class LoginController extends Controller
{
    public function index()
    {
        $user = $this->model('user'); //
        // $product = new Product();
        $data = $user->all();
        // var_dump($data);
        $title = "Đăng nhập";
        $this->view("users/login", [
            'title' => $title,
            'user' => $data,
        ]);
    }
}