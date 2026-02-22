<?php
class OrderController extends Controller
{
    // Trang thành công sau khi đặt hàng
    public function success($orderId)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        $orderModel = $this->model('order');
        $order = $orderModel->findWithItems($orderId);

        // Chỉ cho phép xem đơn của chính mình
        if (!$order || $order['id_user'] != $_SESSION['user_id']) {
            $this->redirect('/');
            return;
        }

        $this->view('order/success', [
            'title' => 'Đặt hàng thành công',
            'order' => $order,
        ]);
    }

    // Lịch sử đơn hàng
    public function history()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/auth/login');
            return;
        }
        $orders = $this->model('order')->getByUser($_SESSION['user_id']);
        $this->view('order/history', [
            'title'  => 'Lịch sử đơn hàng',
            'orders' => $orders,
        ]);
    }
}
