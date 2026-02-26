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
            'id_color' => $data['id_color'] ? $data['id_color'] : null,
            'id_trademark' => $data['id_trademark'] ?? null
        ]);
        return $conn->lastInsertId();
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
        // tao chuoi placeholder: ?,?,?,...
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        // ORDER BY FIELD giu dung thu tu truyen vao (moi xem nhat len dau)
        $sql = "SELECT * FROM {$this->table} WHERE id IN ($placeholders) ORDER BY FIELD(id, $placeholders)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        // truyen ids 2 lan: 1 cho IN(...), 1 cho FIELD(id,...)
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
        $stmt->bindValue(':id_category', $categoryId); 
        $stmt->execute(['id_category' => $categoryId, 'id' => $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // search va phan trang
    public function search($keyword = '', $page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $conn   = $this->connect();
        if ($keyword) {
            $sql  = "SELECT * FROM {$this->table} WHERE name LIKE :kw ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':kw',     '%' . $keyword . '%');
            $stmt->bindValue(':limit',  (int)$perPage,  PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset,   PDO::PARAM_INT);
        } else {
            $sql  = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':limit',  (int)$perPage,  PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset,   PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // dem tong san pham
    public function countSearch($keyword = '')
    {
        $conn = $this->connect();
        if ($keyword) {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table} WHERE name LIKE :kw";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':kw' => '%' . $keyword . '%']);
        } else {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0;
    }

    // thong ke san pham: tong, het hang, con hang, moi
    public function getStats()
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("
            SELECT
                COUNT(*) as total,
                SUM(CASE WHEN quantity <= 0 THEN 1 ELSE 0 END) as out_of_stock,
                SUM(CASE WHEN quantity > 0 THEN 1 ELSE 0 END)  as in_stock,
                SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as new_today
            FROM {$this->table}
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
