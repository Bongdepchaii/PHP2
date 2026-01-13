<?php 
class HomeController extends Controller {
    public function index() {
        $product = $this->model('Product');
        $data = $product->all();
        var_dump($data);
        $title = "Page Home";
        $this->view('home/index', ['title' => $title]);
    }
}
?>