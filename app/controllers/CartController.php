<?php
class CartController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }

        $userId    = $_SESSION['user_id'];
        $cartModel = $this->model('cart');
        $cartItems = $cartModel->findByUser($userId);

        // Tính tổng tiền hàng
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Voucher giảm theo % (value lưu là số 1-100)
        $voucherInfo = $_SESSION['voucher'] ?? null;
        $discount    = 0;
        if ($voucherInfo) {
            $discount = (int)floor($subtotal * $voucherInfo['value'] / 100);
        }
        $total = max(0, $subtotal - $discount);

        // Địa chỉ đã lưu của user (để dùng lúc checkout)
        $addresses = $this->model('address')->getByUserId($userId);

        // Danh sách voucher còn hiệu lực để hiển thị trong modal
        $activeVouchers = $this->model('voucher')->getActiveVouchers();

        $this->view("cart/index", [
            'title'          => "Giỏ hàng",
            'cart'           => $cartItems,
            'subtotal'       => $subtotal,
            'discount'       => $discount,
            'total'          => $total,
            'voucherInfo'    => $voucherInfo,
            'addresses'      => $addresses,
            'activeVouchers' => $activeVouchers,
        ]);
    }

    // Áp dụng mã voucher
    public function applyVoucher()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = strtoupper(trim($_POST['voucher_code'] ?? ''));
            if (empty($code)) {
                $_SESSION['error'] = "Vui lòng nhập mã voucher";
            } else {
                $voucherModel = $this->model('voucher');
                $voucher      = $voucherModel->findByCode($code);
                if ($voucher) {
                    $_SESSION['voucher'] = [
                        'id'    => $voucher['id'],
                        'name'  => $voucher['name'],
                        'value' => $voucher['value'],
                    ];
                    $_SESSION['success'] = "Áp dụng mã \"{$voucher['id']}\" thành công! Giảm {$voucher['value']}%";
                } else {
                    $_SESSION['error'] = "Mã voucher không hợp lệ, đã hết hạn hoặc hết lượt sử dụng";
                }
            }
        }
        $this->redirect('/cart');
    }

    // Cập nhật số lượng sản phẩm trong giỏ (gọi từ JS nút +/-)
    public function updateQuantity($cartId)
    {
        if (!isset($_SESSION['user_id'])) {
            http_response_code(403);
            echo json_encode(['error' => 'Chưa đăng nhập']);
            return;
        }
        $qty = (int)($_POST['quantity'] ?? 1);
        if ($qty < 1) $qty = 1;
        $cartModel = $this->model('cart');
        $cartModel->updateQuantity($cartId, $qty);
        // Tính lại tổng để trả về cho JS cập nhật sidebar
        $cartItems = $cartModel->findByUser($_SESSION['user_id']);
        $subtotal  = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cartItems));
        $voucherInfo = $_SESSION['voucher'] ?? null;
        $discount = $voucherInfo ? (int)floor($subtotal * $voucherInfo['value'] / 100) : 0;
        header('Content-Type: application/json');
        echo json_encode([
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => max(0, $subtotal - $discount),
        ]);
    }

    // Xóa voucher đang áp dụng
    public function removeVoucher()
    {
        unset($_SESSION['voucher']);
        $_SESSION['success'] = "Đã hủy voucher";
        $this->redirect('/cart');
    }

    // Đặt hàng (checkout)
    public function checkout()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/cart');
            return;
        }

        $userId   = $_SESSION['user_id'];
        $receiver = trim($_POST['receiver'] ?? '');
        $phone    = trim($_POST['phone']    ?? '');
        $address  = trim($_POST['address']  ?? '');
        $note     = trim($_POST['note']     ?? '');

        if (empty($receiver) || empty($phone) || empty($address)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin giao hàng";
            $this->redirect('/cart');
            return;
        }

        $cartModel = $this->model('cart');
        $cartItems = $cartModel->findByUser($userId);

        if (empty($cartItems)) {
            $_SESSION['error'] = "Giỏ hàng trống, không thể đặt hàng";
            $this->redirect('/cart');
            return;
        }

        // Tính tiền
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $voucherInfo = $_SESSION['voucher'] ?? null;
        $discount    = $voucherInfo ? (int)floor($subtotal * $voucherInfo['value'] / 100) : 0;
        $total       = max(0, $subtotal - $discount);


        // Tạo đơn hàng
        $orderModel = $this->model('order');
        $orderId    = $orderModel->create([
            'id_user'    => $userId,
            'id_voucher' => $voucherInfo['id'] ?? null,
            'subtotal'   => $subtotal,
            'discount'   => $discount,
            'total'      => $total,
            'receiver'   => $receiver,
            'phone'      => $phone,
            'address'    => $address,
            'note'       => $note,
        ]);

        // Lưu từng sản phẩm vào order_items (snapshot giá + tên)
        foreach ($cartItems as $item) {
            $orderModel->createItem([
                'id_order'     => $orderId,
                'id_product'   => $item['id_product'],
                'product_name' => $item['product_name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
            ]);
        }

        // Trừ lượt dùng voucher
        if ($voucherInfo) {
            $this->model('voucher')->decreaseQuantity($voucherInfo['id']);
            unset($_SESSION['voucher']);
        }

        // Xóa toàn bộ giỏ hàng của user này
        $cartModel->deleteByUser($userId);

        // Chuyển sang trang thành công
        $this->redirect('/order/success/' . $orderId);
    }

    public function add($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để mua hàng";
            $this->redirect('/auth/login');
            return;
        }

        $userId   = $_SESSION['user_id'];
        $quantity = 1;

        $cartModel    = $this->model('cart');
        $existingItem = $cartModel->findItem($userId, $productId);

        if ($existingItem) {
            $result = $cartModel->updateQuantity($existingItem['id'], $existingItem['quantity'] + $quantity);
        } else {
            $result = $cartModel->create([
                'id_user'    => $userId,
                'id_product' => $productId,
                'quantity'   => $quantity
            ]);
        }

        if ($result) {
            $_SESSION['success'] = "Đã thêm sản phẩm vào giỏ hàng vui lòng vào giỏ hàng để mua hàng";
        } else {
            $_SESSION['error'] = "Lỗi khi thêm vào giỏ hàng";
        }

        $this->redirect('/');
    }

    public function delete($id) {
        $cartModel = $this->model('cart');
        $result    = $cartModel->delete($id);
        if ($result) {
            $_SESSION['success'] = "Đã xóa sản phẩm khỏi giỏ hàng";
        } else {
            $_SESSION['error'] = "Lỗi khi xóa sản phẩm khỏi giỏ hàng";
        }
        $this->redirect('/cart');
    }
}