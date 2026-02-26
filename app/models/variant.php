<?php
class Variant extends Model
{
    private $table = "variant";
    public function all()
    {
        $sql = "select * from $this->table";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "select * from $this->table where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $sql = "insert into $this->table (id_product, id_color, id_rom, price, quantity) VALUES (:id_product, :id_color, :id_rom, :price, :quantity)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id_product' => $data['id_product'],
            'id_color'   => $data['id_color'],
            'id_rom'     => $data['id_rom'],
            'price'      => $data['price'],
            'quantity'   => $data['quantity']
        ]);
    }

    public function update($data = [], $id)
    {
        $sql = "update $this->table set name = :name where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'id' => (int)$id
        ]);
    }

    public function delete($id)
    {
        $sql = "delete from $this->table where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function getByProductId($productId)
    {
        $sql = "select * from $this->table where id_product = :id_product";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute(['id_product' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByProductId($productId)
    {
        $sql = "delete from $this->table where id_product = :id_product";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute(['id_product' => $productId]);
    }
}