<?php
class CartController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $cartModel = $this->model('cart');
        $cartItems = $cartModel->findByUser($userId);
        
        $this->view("cart/index", [
            'title' => "Giỏ hàng",
            'cart' => $cartItems,
        ]);
    }

    public function add($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            // Store redirect URL? For now illegal clean redirect
            $_SESSION['error'] = "Vui lòng đăng nhập để mua hàng";
            $this->redirect('/auth/login');
            return;
        }

        $userId = $_SESSION['user_id'];
        $quantity = 1; // Default quantity

        $cartModel = $this->model('cart');
        
        // Check if item exists
        $existingItem = $cartModel->findItem($userId, $productId);

        if ($existingItem) {
            $newQuantity = $existingItem['quantity'] + $quantity;
            $result = $cartModel->updateQuantity($existingItem['id'], $newQuantity);
        } else {
            $result = $cartModel->create([
                'id_user' => $userId,
                'id_product' => $productId,
                'quantity' => $quantity
            ]);
        }

        if ($result) {
            $_SESSION['success'] = "Đã thêm sản phẩm vào giỏ hàng";
        } else {
            $_SESSION['error'] = "Lỗi khi thêm vào giỏ hàng";
        }

        $this->redirect('/cart');
    }

    public function delete($id) {
        $cartModel = $this->model('cart');
        $result = $cartModel->delete($id);
        if ($result) {
            $_SESSION['success'] = "Đã xóa sản phẩm khỏi giỏ hàng";
        } else {
            $_SESSION['error'] = "Lỗi khi xóa sản phẩm khỏi giỏ hàng";
        }
        $this->redirect('/cart');
    }
}