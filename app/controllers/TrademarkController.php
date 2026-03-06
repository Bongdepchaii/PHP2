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

    public function add()
    {
            if (!$_SESSION['user_id']) {
                $_SESSION['error'] = "Bạn chưa đăng nhập";
                $this->redirect('/auth/login');
                return;
            }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $img = "";
            
            if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                $uploadDir = 'app/images/img/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['img']['name']);
                $targetFile = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                    $img = $fileName;
                }
            }

            if (!empty($name)) {
                $trademarkModel = $this->model('trademark');
                $trademarkModel->create(array(
                    'name' => $name,
                    'img' => $img,
                    'created_at' => date('Y-m-d H:i:s')
                ));
                $_SESSION['success'] = "Thêm thương hiệu thành công";
            }
        }
        $this->redirect('/trademark');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $trademarkModel = $this->model('trademark');
            $currentTrademark = $trademarkModel->find($id);
            $img = $currentTrademark['img'];

            if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
                $uploadDir = 'app/images/img/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = time() . '_' . basename($_FILES['img']['name']);
                $targetFile = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                    $img = $fileName;
                }
            }

            if (!empty($name)) {
                $updateData = [
                    'name' => $name,
                    'img' => $img,
                    'created_at' => $currentTrademark['created_at'] ?? date('Y-m-d H:i:s')
                ];
                
                $trademarkModel->update($updateData, $id);
                
                $_SESSION['success'] = "Cập nhật thành công";
            }
        }
        $this->redirect('/trademark');
    }

        public function delete($id){
        $trademark = $this->model(name: 'trademark');
        $trademark->delete($id);
        $this->redirect('/trademark');
    }
}