<?php
class OrderController extends Controller
{
    // USER

    public function success($orderId)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        $orderModel = $this->model('order');
        $order      = $orderModel->findWithItems($orderId);

        if (!$order || $order['id_user'] != $_SESSION['user_id']) {
            $this->redirect('/');
            return;
        }

        $user = $this->model('user')->find($_SESSION['user_id']);
        $this->view('order/success', [
            'title' => 'Đặt hàng thành công',
            'order' => $order,
            'user'  => $user,
        ]);
    }

    public function history()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        $user   = $this->model('user')->find($_SESSION['user_id']);
        $orders = $this->model('order')->getByUser($_SESSION['user_id']);
        $this->view('order/history', [
            'title'  => 'Đơn hàng của tôi',
            'orders' => $orders,
            'user'   => $user,
        ]);
    }

    public function cancel($orderId)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }

        $orderModel = $this->model('order');
        $order      = $orderModel->findWithItems($orderId);

        if (!$order || $order['id_user'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng";
            $this->redirect('/order/history');
            return;
        }

        if ($order['status'] !== 'pending') {
            $_SESSION['error'] = "Chỉ có thể hủy đơn đang ở trạng thái 'Chờ xử lý'";
            $this->redirect('/order/history');
            return;
        }

        $orderModel->updateStatus($orderId, 'cancelled');

        $_SESSION['success'] = "Đã hủy đơn hàng #" . $orderId;
        $this->redirect('/order/history');
    }

    public function reorder($orderId)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }

        $orderModel = $this->model('order');
        $order      = $orderModel->findWithItems($orderId);

        if (!$order || $order['id_user'] != $_SESSION['user_id']) {
            $this->redirect('/order/history');
            return;
        }

        $cartModel = $this->model('cart');
        $userId    = $_SESSION['user_id'];

        foreach ($order['items'] as $item) {
            $existing = $cartModel->findItem($userId, $item['id_product']);
            if ($existing) {
                $cartModel->updateQuantity($existing['id'], $existing['quantity'] + $item['quantity']);
            } else {
                $cartModel->create([
                    'id_user'    => $userId,
                    'id_product' => $item['id_product'],
                    'quantity'   => $item['quantity'],
                ]);
            }
        }

        $_SESSION['success'] = "Đã thêm lại sản phẩm vào giỏ hàng";
        $this->redirect('/cart');
    }

    // ADMIN

    public function index()
    {
        $status = $_GET['status'] ?? null;
        $orders = $this->model('order')->getAllWithUser($status);
        $counts = $this->model('order')->countByStatus();

        $this->view('order/index', [
            'title'        => 'Quản lý đơn hàng',
            'orders'       => $orders,
            'counts'       => $counts,
            'activeStatus' => $status,
        ]);
    }

    public function updateStatus($orderId)
    {
        $newStatus = $_POST['status'] ?? '';
        $allowed   = ['pending', 'confirmed', 'shipping', 'done', 'cancelled'];

        if (!in_array($newStatus, $allowed)) {
            $_SESSION['error'] = "Trạng thái không hợp lệ";
        } else {
            $this->model('order')->updateStatus($orderId, $newStatus);
            $_SESSION['success'] = "Đã cập nhật trạng thái đơn hàng #" . $orderId;
        }

        $from = $_POST['from_status'] ?? '';
        $qs   = $from ? '?status=' . $from : '';
        $this->redirect('/order/index' . $qs);
    }

    public function detail($orderId)
    {
        $orderModel = $this->model('order');
        $order      = $orderModel->findWithItems($orderId);

        if (!$order) {
            $_SESSION['error'] = "Không tìm thấy đơn hàng";
            $this->redirect('/order/index');
            return;
        }

        $this->view('order/detail', [
            'title' => 'Chi tiết đơn #' . $orderId,
            'order' => $order,
        ]);
    }
}
