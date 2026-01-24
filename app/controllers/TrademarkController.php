<?php
class TrademarkController extends Controller
{
    public function index()
    {
        $trademark = $this->model('trademark'); //
        // $product = new Product();
        $data = $trademark->all();
        // var_dump($data);
        $title = "Quản lý thương hiệu";
        $this->view("trademarks/index", [
            'title' => $title,
            'trademark' => $data,
        ]);
    }

        public function delete($id){
        $trademark = $this->model(name: 'trademark');
        $trademark->delete($id);
        header("Location: /trademark/index");
    }
}