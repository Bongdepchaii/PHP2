<?php
class Order extends Model
{
    private $table      = 'orders';
    private $tableItems = 'order_items';

    // tao don hang, tra ve id vua insert
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

    // them tung san pham vao order_items
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

    // lay lich su don hang cua user
    public function getByUser($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // chi tiet 1 don hang kem items
    public function findWithItems($orderId)
    {
        $conn = $this->connect();
        $order = $conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $order->execute(['id' => $orderId]);
        $orderData = $order->fetch(PDO::FETCH_ASSOC);
        if (!$orderData) return null;

        $items = $conn->prepare("SELECT * FROM {$this->tableItems} WHERE id_order = :id_order");
        $items->execute(['id_order' => $orderId]);
        $orderData['items'] = $items->fetchAll(PDO::FETCH_ASSOC);
        return $orderData;
    }

    // chi lay items cua don
    public function getItems($orderId)
    {
        $sql = "SELECT * FROM {$this->tableItems} WHERE id_order = :id_order";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_order' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // cap nhat trang thai don hang
    public function updateStatus($orderId, $status)
    {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['status' => $status, 'id' => $orderId]);
    }

    // lay toan bo don hang, join ten user
    public function getAllWithUser($status = null)
    {
        $sql = "SELECT o.*, u.name as user_name, u.email as user_email
                FROM {$this->table} o
                JOIN user u ON o.id_user = u.id";
        $params = [];
        if ($status) {
            $sql .= " WHERE o.status = :status";
            $params['status'] = $status;
        }
        $sql .= " ORDER BY o.created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // dem don theo tung trang thai
    public function countByStatus()
    {
        $sql = "SELECT status, COUNT(*) as total FROM {$this->table} GROUP BY status";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rows   = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $counts = [];
        foreach ($rows as $r) {
            $counts[$r['status']] = $r['total'];
        }
        return $counts;
    }

    // thong ke doanh thu

    // tong quan don, doanh thu, don huy, don hoan thanh (loc ngay/thang/nam)
    public function getRevenueSummary($dateFrom = null, $dateTo = null)
    {
        $conn   = $this->connect();
        $where  = 'WHERE 1=1';
        $params = [];
        if ($dateFrom) { $where .= ' AND DATE(created_at) >= :from'; $params['from'] = $dateFrom; }
        if ($dateTo)   { $where .= ' AND DATE(created_at) <= :to';   $params['to']   = $dateTo;   }

        $sql = "SELECT
                    COUNT(*) as total_orders,
                    SUM(CASE WHEN status = 'done' THEN total    ELSE 0 END) as total_revenue,
                    SUM(CASE WHEN status = 'done' THEN discount ELSE 0 END) as total_discount,
                    SUM(CASE WHEN status = 'done'      THEN 1 ELSE 0 END) as done_orders,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_orders
                FROM {$this->table} $where";
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'total_orders'     => $row['total_orders']     ?? 0,
            'total_revenue'    => $row['total_revenue']    ?? 0,
            'total_discount'   => $row['total_discount']   ?? 0,
            'done_orders'      => $row['done_orders']      ?? 0,
            'cancelled_orders' => $row['cancelled_orders'] ?? 0,
        ];
    }

    // doanh thu theo ngay
    public function getRevenueByDay($dateFrom = null, $dateTo = null)
    {
        $conn   = $this->connect();
        $where  = "WHERE status = 'done'";
        $params = [];
        if ($dateFrom) { $where .= " AND DATE(created_at) >= :from"; $params['from'] = $dateFrom; }
        if ($dateTo)   { $where .= " AND DATE(created_at) <= :to";   $params['to']   = $dateTo;   }
        $sql = "SELECT DATE(created_at) as day, SUM(total) as revenue, COUNT(*) as orders
                FROM {$this->table} $where
                GROUP BY DATE(created_at) ORDER BY day ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // top sp ban chay
    public function getTopProducts($limit = 5, $dateFrom = null, $dateTo = null)
    {
        $conn   = $this->connect();
        $where  = "WHERE o.status = 'done'";
        $params = [];
        if ($dateFrom) { $where .= " AND DATE(o.created_at) >= :from"; $params['from'] = $dateFrom; }
        if ($dateTo)   { $where .= " AND DATE(o.created_at) <= :to";   $params['to']   = $dateTo;   }
        $sql = "SELECT oi.product_name, SUM(oi.quantity) as total_qty, SUM(oi.quantity * oi.price) as total_revenue
                FROM {$this->tableItems} oi
                JOIN {$this->table} o ON oi.id_order = o.id
                $where
                GROUP BY oi.product_name
                ORDER BY total_qty DESC
                LIMIT $limit";
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // doanh thu theo thang trong nam
    public function getRevenueByMonth($year = null)
    {
        $year   = $year ?: date('Y');
        $conn   = $this->connect();
        $sql = "SELECT MONTH(created_at) as month, SUM(total) as revenue, COUNT(*) as orders
                FROM {$this->table}
                WHERE status = 'done' AND YEAR(created_at) = :year
                GROUP BY MONTH(created_at) ORDER BY month ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
