<?php
class VoucherController extends Controller
{
    public function index()
    {
        $voucher = $this->model('voucher'); //
        // $product = new Product();
        $data = $voucher->all();
        // var_dump($data);
        $title = "Quản lý voucher";
        $this->view("vouchers/index", [
            'title' => $title,
            'voucher' => $data,
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $voucherModel = $this->model('voucher');
            
            $name = $_POST['name'] ?? '';
            $id_voucher = $_POST['id_voucher'] ?? '';
            $value = $_POST['value'] ?? 0;
            $quanity = $_POST['quanity'] ?? 0;
            $status = $_POST['status'] ?? 'active';
            $end_date = $_POST['end_date'] ?? date('Y-m-d');
            
            // Check if ID exists or auto-generate? The form should probably have it.
            // If not provided in form, we might need to generate it or require it.
            if (empty($id_voucher)) {
                $id_voucher = strtoupper(substr(md5(uniqid()), 0, 10)); // Auto generate if empty
            }

            $result = $voucherModel->create([
                'id_voucher' => $id_voucher,
                'name' => $name,
                'value' => $value,
                'quanity' => $quanity,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'end_date' => $end_date
            ]);

            if ($result) {
                $_SESSION['success'] = "Thêm voucher thành công";
            } else {
                $_SESSION['error'] = "Thêm voucher thất bại";
            }
            
            $this->redirect('/voucher/index');
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $voucherModel = $this->model('voucher');
            
            $data = [
                'name' => $_POST['name'],
                'value' => $_POST['value'],
                'quanity' => $_POST['quanity'],
                'status' => $_POST['status'],
                'end_date' => $_POST['end_date']
            ];

            // If id_voucher is editable, include it, but usually PK is not editable easily.
            // We'll update other fields based on the PK passed in URL/Method.

            $result = $voucherModel->update($data, $id);

            if ($result) {
                $_SESSION['success'] = "Cập nhật voucher thành công";
            } else {
                $_SESSION['error'] = "Cập nhật voucher thất bại";
            }
            
            $this->redirect('/voucher/index');
        }
    }

    public function delete($id)
    {
        $voucherModel = $this->model('voucher');
        $result = $voucherModel->delete($id);
        
        if ($result) {
             $_SESSION['success'] = "Xóa voucher thành công";
        } else {
             $_SESSION['error'] = "Xóa voucher thất bại";
        }
        
        $this->redirect('/voucher/index');
    }
}
?>
