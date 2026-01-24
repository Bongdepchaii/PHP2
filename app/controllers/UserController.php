<?php
class UserController extends Controller
{
    public function index()
    {
        $user = $this->model('user'); //
        // $product = new Product();
        $data = $user->all();
        // var_dump($data);
        $title = "Quản lý người dùng";
        $this->view("users/index", [
            'title' => $title,
            'user' => $data,
        ]);
    }

    public function delete($id) {
        $user = $this->model('user');
        $user->delete($id);
        header("Location: /user");
    }
}