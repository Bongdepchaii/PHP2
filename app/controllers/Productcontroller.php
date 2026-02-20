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
        $productModel = $this->model('product');
        $categoryModel = $this->model('category');
        $colorModel = $this->model('color');

        $products = $productModel->all();
        $categories = $categoryModel->all();
        $colors = $colorModel->all();

        $title = "Quản lý sản phẩm";
        $this->view("products/index", [
            'title' => $title,
            'products' => $products,
            'categories' => $categories,
            'colors' => $colors
        ]);
    }

    
    public function delete($id){
        $product = $this->model('product');
        $product->delete($id);
        $this->redirect('/product/index');
    }


    public function add() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $quantity = trim($_POST['quantity']);
            $mota = trim($_POST['mota']);
            $created_at = date('Y-m-d H:i:s');
            $id_category = trim($_POST['id_category']);
            $id_color = trim($_POST['id_color']);
            
            $finalImages = [];
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/app/images/img/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            if (isset($_FILES['main_img']) && $_FILES['main_img']['error'] == 0) {
                $fileName = time() . '_main_' . basename($_FILES['main_img']['name']);
                if (move_uploaded_file($_FILES['main_img']['tmp_name'], $uploadPath . $fileName)) {
                    $finalImages[] = $fileName;
                }
            }
            if (isset($_FILES['gallery_img']) && !empty($_FILES['gallery_img']['name'][0])) {
                $totalFiles = count($_FILES['gallery_img']['name']);
                for ($i = 0; $i < $totalFiles; $i++) {
                   if ($_FILES['gallery_img']['error'][$i] == 0) {
                       $fileName = time() . '_gal_' . $i . '_' . basename($_FILES['gallery_img']['name'][$i]);
                       if (move_uploaded_file($_FILES['gallery_img']['tmp_name'][$i], $uploadPath . $fileName)) {
                           $finalImages[] = $fileName;
                       }
                   }
                }
            }
            
            $imgJson = !empty($finalImages) ? json_encode($finalImages) : "";

            if (!empty($name)) {
                $productModel = $this->model('product');
                $productModel->create([
                    'name' => $name,
                    'price' => $price,
                    'img' => $imgJson,
                    'quantity' => $quantity,
                    'mota' => $mota,
                    'created_at' => $created_at,
                    'id_category' => $id_category,
                    'id_color' => $id_color
                ]);
                $_SESSION['success'] = "Thêm sản phẩm thành công";
            }
            $this->redirect('/product/');
        } else {
            $this->redirect('/product/');
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $quantity = trim($_POST['quantity']);
            $mota = trim($_POST['mota']);
            $created_at = date('Y-m-d H:i:s');
            $id_category = trim($_POST['id_category']);
            $id_color = trim($_POST['id_color']);
            
            $productModel = $this->model('product');
            $currentProduct = $productModel->find($id);

            $decoded = json_decode($currentProduct['img'], true);
            if (is_array($decoded)) {
                $currentImages = $decoded;
            } else {
                if (!empty($currentProduct['img'])) {
                     $currentImages = [$currentProduct['img']];
                } else {
                     $currentImages = [];
                }
            }
            
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/app/images/img/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $newMainInfo = null;
            if (isset($_FILES['main_img']) && $_FILES['main_img']['error'] == 0) {
                $fileName = time() . '_update_main_' . basename($_FILES['main_img']['name']);
                if (move_uploaded_file($_FILES['main_img']['tmp_name'], $uploadPath . $fileName)) {
                    $newMainInfo = $fileName;
                }
            }

            $finalMain = $newMainInfo ? $newMainInfo : ($currentImages[0] ?? null);

            $newGallery = [];
            $hasNewGallery = false;
            if (isset($_FILES['gallery_img']) && !empty($_FILES['gallery_img']['name'][0])) {

                 if ($_FILES['gallery_img']['error'][0] == 0) {
                    $hasNewGallery = true;
                    $totalFiles = count($_FILES['gallery_img']['name']);
                    for ($i = 0; $i < $totalFiles; $i++) {
                       if ($_FILES['gallery_img']['error'][$i] == 0) {
                           $fileName = time() . '_update_gal_' . $i . '_' . basename($_FILES['gallery_img']['name'][$i]);
                           if (move_uploaded_file($_FILES['gallery_img']['tmp_name'][$i], $uploadPath . $fileName)) {
                               $newGallery[] = $fileName;
                           }
                       }
                    }
                 }
            }
            
            if ($hasNewGallery) {
                $finalGallery = $newGallery;
            } else {
                $finalGallery = array_slice($currentImages, 1);
            }

            $finalList = [];

            if ($finalMain) $finalList[] = $finalMain;
            $finalList = array_merge($finalList, $finalGallery);

            $imgJson = !empty($finalList) ? json_encode($finalList) : "";

            if (!empty($name)) {
                $productModel->update([
                    'name' => $name,
                    'price' => $price,
                    'img' => $imgJson,
                    'quantity' => $quantity,
                    'mota' => $mota,
                    'id_category' => $id_category,
                    'id_color' => $id_color
                ], $id);
                $_SESSION['success'] = "Cập nhật thành công";
            }
        }
        $this->redirect('/product/index');
    }

        function add_variant(){
        /**
         *  xử lý method post
         *  kiểm tra trùng, validate 
         *  thêm thành công ->
         *  dùng js để load lên giao diện người dùng
         */
        header('Content-Type: application/json');
        $variant = $this->model('variant');

        $data = array(
            'sizeId' => 1,
            'colorId' => 2,
            'image' => '',
            'quantity' => 5
        );
        $variant->create($data);
        $json_string = json_encode($data);
        echo $json_string;
    }

    function product_detail($id){
        $productmodel = $this->model('product');
        $product = $productmodel->find($id);
        $title = "Chi tiết sản phẩm";
        $this->view("products/detail", [
            'title' => $title,
            'product' =>$product
        ]);
    }

    // San pham lien quan
    function product_related($id){
        $productmodel = $this->model('product');
        $currentProduct = $productmodel->find($id);
        $relatedProducts = $productmodel->where('id_category', $currentProduct['id_category']);
        $title = "Sản phẩm liên quan";
        $this->view("products/related", [
            'title' => $title,
            'products' => $relatedProducts
        ]);
    }
}

