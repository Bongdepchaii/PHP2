<?php
class Product extends Model
{
    private $table = 'product';
    public function all()
    {
        $sql = "Select * from " . $this->table;
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

    public function create($data = [], $id) {
        $sql = "insert into $this->table (name, price) values (:name, :price)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'name' => $data['name'], 'price' => $data['price'] ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data = [], $id) {
        $sql = "update $this->table set name = :name, price = :price where id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'name' => $data['name'], 'price' => $data['price'], 'id' => $id ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "delete from $this->table where id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute([ 'id' => $id ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
