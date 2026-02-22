<?php
class Address extends Model
{
    private $table = 'user_address';

    // Lấy tất cả địa chỉ của một user
    public function getByUserId($userId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY is_default DESC, created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm địa chỉ mới
    public function create($data = [])
    {
        $sql = "INSERT INTO {$this->table} (user_id, label, receiver, phone, address, is_default, created_at)
                VALUES (:user_id, :label, :receiver, :phone, :address, :is_default, :created_at)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'user_id'    => $data['user_id'],
            'label'      => $data['label'],
            'receiver'   => $data['receiver'],
            'phone'      => $data['phone'],
            'address'    => $data['address'],
            'is_default' => $data['is_default'] ?? 0,
            'created_at' => $data['created_at'],
        ]);
    }

    // Xóa địa chỉ (kèm user_id để bảo mật: user chỉ xóa được địa chỉ của chính mình)
    public function delete($id, $userId)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = :id AND user_id = :user_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id, 'user_id' => $userId]);
    }

    // Đặt địa chỉ mặc định: bỏ default tất cả → set default cho id được chọn
    public function setDefault($id, $userId)
    {
        $conn = $this->connect();
        // Bước 1: Bỏ tất cả default của user này
        $stmt = $conn->prepare("UPDATE {$this->table} SET is_default = 0 WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        // Bước 2: Set default cho địa chỉ được chọn
        $stmt2 = $conn->prepare("UPDATE {$this->table} SET is_default = 1 WHERE id = :id AND user_id = :user_id");
        return $stmt2->execute(['id' => $id, 'user_id' => $userId]);
    }
}
