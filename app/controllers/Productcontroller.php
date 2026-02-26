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
        $productModel   = $this->model('product');
        $categoryModel  = $this->model('category');
        $colorModel     = $this->model('color');
        $trademarkModel = $this->model('trademark');
        $romModel       = $this->model('rom');
        $keyword  = trim($_GET['q']    ?? '');
        $page     = max(1, (int)($_GET['page'] ?? 1));
        $perPage  = 10;

        $products  = $productModel->search($keyword, $page, $perPage);
        $total     = $productModel->countSearch($keyword);
        $totalPage = (int)ceil($total / $perPage);
        
        $variantModel = $this->model('variant');
        foreach ($products as &$product) {
            $product['variants'] = $variantModel->getByProductId($product['id']);
        }

        $categories = $categoryModel->all();
        $colors     = $colorModel->all();
        $trademarks = $trademarkModel->all();
        $roms       = $romModel->all();

        $this->view("products/index", [
            'title'      => 'Quản lý sản phẩm',
            'products'   => $products,
            'categories' => $categories,
            'colors'     => $colors,
            'trademarks' => $trademarks,
            'roms'       => $roms,
            // Phân trang & tìm kiếm
            'keyword'    => $keyword,
            'page'       => $page,
            'perPage'    => $perPage,
            'total'      => $total,
            'totalPage'  => $totalPage,
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
            $id_trademark = trim($_POST['id_trademark']);
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
                $newProductId = $productModel->create([
                    'name' => $name,
                    'price' => $price,
                    'img' => $imgJson,
                    'quantity' => $quantity,
                    'mota' => $mota,
                    'created_at' => $created_at,
                    'id_category' => $id_category,
                    'id_trademark' => $id_trademark,
                    'id_color' => $id_color
                ]);

                // add variant if exist22222222222222222222222222222
                if ($newProductId && isset($_POST['variant_id_color'])) {
                    $variantModel = $this->model('variant');
                    $variantColors = $_POST['variant_id_color'];
                    $variantRoms   = $_POST['variant_id_rom'];
                    $variantPrices = $_POST['variant_price'];
                    $variantQties  = $_POST['variant_quantity'];

                    for ($i = 0; $i < count($variantColors); $i++) {
                        if (!empty($variantColors[$i]) && !empty($variantRoms[$i])) {
                            $variantModel->create([
                                'id_product' => $newProductId,
                                'id_color'   => $variantColors[$i],
                                'id_rom'     => $variantRoms[$i],
                                'price'      => $variantPrices[$i] ?? 0,
                                'quantity'   => $variantQties[$i] ?? 0
                            ]);
                        }
                    }
                }

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
            $id_trademark = trim($_POST['id_trademark']);
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
                    'id_trademark' => $id_trademark,
                    'id_color' => $id_color ? $id_color : null
                ], $id);

                // --- XỬ LÝ VARIANT KHI UPDATE ---
                $variantModel = $this->model('variant');
                // Xoá toàn bộ variant cũ của sản phẩm này
                $variantModel->deleteByProductId($id);

                // Thêm lại các variant mới (nếu có push lên từ form)
                if (isset($_POST['variant_id_color'])) {
                    $variantColors = $_POST['variant_id_color'];
                    $variantRoms   = $_POST['variant_id_rom'];
                    $variantPrices = $_POST['variant_price'];
                    $variantQties  = $_POST['variant_quantity'];

                    for ($i = 0; $i < count($variantColors); $i++) {
                        if (!empty($variantColors[$i]) && !empty($variantRoms[$i])) {
                            $variantModel->create([
                                'id_product' => $id,
                                'id_color'   => $variantColors[$i],
                                'id_rom'     => $variantRoms[$i],
                                'price'      => $variantPrices[$i] ?? 0,
                                'quantity'   => $variantQties[$i] ?? 0
                            ]);
                        }
                    }
                }

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

    //  san pham chi tiet
    function detail($id){
        $productModel = $this->model('product');
        $product = $productModel->find($id);
        
        if (!$product) {
            $this->notFound("Sản phẩm không tồn tại");
            return;
        }

        // --- LẤY BIẾN THỂ VÀ DANH SÁCH MÀU, ROM ---
        $variantModel = $this->model('variant');
        $variants = $variantModel->getByProductId($id);
        
        $colorModel = $this->model('color');
        $romModel   = $this->model('rom');
        
        $allColors = $colorModel->all();
        $allRoms   = $romModel->all();

        // Save Session
        $recentlyViewed = $_SESSION['recently_viewed'] ?? [];

        // xoa id hien tai neu da co trong danh sach
        $recentlyViewed = array_values(array_filter($recentlyViewed, fn($i) => $i != $id));

        // them id sp hien tai vao danh sach
        array_unshift($recentlyViewed, (int)$id);

        // gioi han toi da 5 sp ds
        $recentlyViewed = array_slice($recentlyViewed, 0, 5);

        // luu session
        $_SESSION['recently_viewed'] = $recentlyViewed;

        // Bước 6: lay id sp da xem
        $recentIds = array_values(array_filter($recentlyViewed, fn($i) => $i != $id));

        // truy van du lieu da xem db
        $recentProducts = !empty($recentIds) ? $productModel->findByIds($recentIds) : [];

        // nhan san pham lien quan
        $relatedProducts = $productModel->getRelated($product['id_category'], $id, 4);

        $title = "Chi tiết sản phẩm";
        $this->view("products/detail", [
            'title' => $title,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'recentProducts' => $recentProducts,
            'variants' => $variants,
            'allColors' => $allColors,
            'allRoms' => $allRoms
        ]);
    }

}

