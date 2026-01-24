<?php
class Productcontroller extends Controller
{
    // private $role = ['admin'];
    // function __construct(){
    //     if(in_array($_SESSION['role'],$this->role)){
    //         return $this->redirect('/home');
    //     }
    // }
    public function index()
    {
        $product = $this->model('product'); //
        // $product = new Product();
        $data = $product->all();
        // var_dump($data);
        $title = "Quản lý sản phẩm";
        $this->view("products/index", [
            'title' => $title,
            'products' => $data,
        ]);
    }

    
    public function delete($id){
        $product = $this->model('product');
        $product->delete($id);
        header("Location: /product/index");
    }


        public function add() 
    {
        $title = "Thêm sản phẩm";
        $this->view("products/add", [
            'title' => $title,
            
        ]);
    }
}

