<?php
class RegisterController extends Controller
{
    public function index()
    {
        $product = $this->model('user'); //
        // $product = new Product();
        $data = $product->all();
        // var_dump($data);
        $title = "Đăng ký";
        $this->view("users/register", [
            'title' => $title,
            'user' => $data,
        ]);
    }
}