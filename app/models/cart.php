<?php
class Cart extends Model
{
    private $table = "cart";
    
    // Find all items for a specific user
    public function findByUser($userId)
    {
        $sql = "SELECT c.*, p.name as product_name, p.price, p.img 
                FROM $this->table c 
                JOIN product p ON c.id_product = p.id 
                WHERE c.id_user = :id_user";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute(['id_user' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Find specific item in cart for a user
    public function findItem($userId, $productId)
    {
        $sql = "SELECT * FROM $this->table WHERE id_user = :id_user AND id_product = :id_product";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id_user'    => $userId,
            'id_product' => $productId
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $sql = "INSERT INTO $this->table (id_user, id_product, quantity) VALUES (:id_user, :id_product, :quantity)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id_user'    => $data['id_user'],
            'id_product' => $data['id_product'],
            'quantity'   => $data['quantity']
        ]);
    }

    public function updateQuantity($id, $quantity) {
        $sql = "UPDATE $this->table SET quantity = :quantity WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'quantity' => $quantity,
            'id'       => $id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Xóa toàn bộ giỏ hàng của user sau khi đặt hàng thành công
    public function deleteByUser($userId) {
        $sql = "DELETE FROM $this->table WHERE id_user = :id_user";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id_user' => $userId]);
    }
}
?>