<?php
class Product extends Model
{
    private $table = 'product';
    public function all()
    {
        $sql = "Select * from " . $this->table . " order by created_at desc ";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $sql = "select * from $this->table where id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [], $id = null) {
        $sql = "insert into $this->table (name, price, img, quantity, mota, id_category, id_color, id_trademark, created_at) values (:name, :price, :img, :quantity, :mota, :id_category, :id_color, :id_trademark, :created_at)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 
            'name' => $data['name'], 
            'price' => $data['price'],
            'img' => $data['img'],
            'quantity' => $data['quantity'],
            'mota' => $data['mota'],
            'created_at' => $data['created_at'],
            'id_category' => $data['id_category'],
            'id_color' => $data['id_color'],
            'id_trademark' => $data['id_trademark'] ?? null
        ]);
        return true;
    }

    public function update($data = [], $id) {
        $sql = "update $this->table set name = :name, price = :price, img = :img, quantity = :quantity, mota = :mota, id_category = :id_category, id_color = :id_color, id_trademark = :id_trademark where id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 
            'name' => $data['name'], 
            'price' => $data['price'],
            'img' => $data['img'],
            'quantity' => $data['quantity'],
            'mota' => $data['mota'],
            'id_category' => $data['id_category'],
            'id_color' => $data['id_color'],
            'id_trademark' => $data['id_trademark'] ?? null,
            'id' => $id 
        ]);
        return true;
    }

    public function delete($id) {
        $sql = "delete from $this->table where id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'id' => $id ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findByCategory($categoryId) {
        $sql = "select * from $this->table where id_category = :id_category order by created_at desc";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_category' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByTrademark($trademarkId) {
        $sql = "select * from $this->table where id_trademark = :id_trademark order by created_at desc";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_trademark' => $trademarkId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByIds($ids) {
        if (empty($ids)) return [];
        // Tạo chuỗi placeholder: ?,?,?,...
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        // ORDER BY FIELD giữ đúng thứ tự truyền vào (mới xem nhất lên đầu)
        $sql = "SELECT * FROM {$this->table} WHERE id IN ($placeholders) ORDER BY FIELD(id, $placeholders)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        // Truyền $ids 2 lần: 1 cho IN(...), 1 cho FIELD(id,...)
        $params = array_merge(array_values($ids), array_values($ids));
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRelated($categoryId, $excludeId, $limit = 4) {
        $sql = "select * from $this->table where id_category = :id_category and id != :id order by rand() limit $limit";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_category', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':id', $excludeId, PDO::PARAM_INT);
        // Bind limit as int since PDO sometimes quotes numbers if not specified
        $stmt->bindValue(':id_category', $categoryId); 
        // Re-binding simplicied:
        $stmt->execute(['id_category' => $categoryId, 'id' => $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
