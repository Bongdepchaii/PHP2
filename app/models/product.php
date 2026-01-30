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
        $sql = "insert into $this->table (name, price, img, quantity, mota, id_category, id_color) values (:name, :price, :img, :quantity, :mota, :id_category, :id_color)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 
            'name' => $data['name'], 
            'price' => $data['price'],
            'img' => $data['img'],
            'quantity' => $data['quantity'],
            'mota' => $data['mota'],
            'id_category' => $data['id_category'],
            'id_color' => $data['id_color']
        ]);
        return true;
    }

    public function update($data = [], $id) {
        $sql = "update $this->table set name = :name, price = :price, img = :img, quantity = :quantity, mota = :mota, id_category = :id_category, id_color = :id_color where id = :id";
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
}
