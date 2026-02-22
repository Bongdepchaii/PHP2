<?php
class Order extends Model
{
    private $table      = 'orders';
    private $tableItems = 'order_items';

    // Tạo đơn hàng, trả về ID vừa insert
    public function create($data = [])
    {
        $sql = "INSERT INTO {$this->table}
                    (id_user, id_voucher, subtotal, discount, total, receiver, phone, address, note, status, created_at)
                VALUES
                    (:id_user, :id_voucher, :subtotal, :discount, :total, :receiver, :phone, :address, :note, :status, :created_at)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'id_user'    => $data['id_user'],
            'id_voucher' => $data['id_voucher'] ?? null,
            'subtotal'   => $data['subtotal'],
            'discount'   => $data['discount'] ?? 0,
            'total'      => $data['total'],
            'receiver'   => $data['receiver'],
            'phone'      => $data['phone'],
            'address'    => $data['address'],
            'note'       => $data['note'] ?? '',
            'status'     => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $conn->lastInsertId();
    }

    // Thêm từng sản phẩm vào order_items
    public function createItem($data = [])
    {
        $sql = "INSERT INTO {$this->tableItems}
                    (id_order, id_product, product_name, price, quantity)
                VALUES
                    (:id_order, :id_product, :product_name, :price, :quantity)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'id_order'     => $data['id_order'],
            'id_product'   => $data['id_product'],
            'product_name' => $data['product_name'],
            'price'        => $data['price'],
            'quantity'     => $data['quantity'],
        ]);
    }

    // Lấy lịch sử đơn hàng của user
    public function getByUser($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Chi tiết 1 đơn hàng
    public function findWithItems($orderId)
    {
        $conn = $this->connect();
        $order = $conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $order->execute(['id' => $orderId]);
        $orderData = $order->fetch(PDO::FETCH_ASSOC);

        $items = $conn->prepare("SELECT * FROM {$this->tableItems} WHERE id_order = :id_order");
        $items->execute(['id_order' => $orderId]);
        $orderData['items'] = $items->fetchAll(PDO::FETCH_ASSOC);
        return $orderData;
    }
}
