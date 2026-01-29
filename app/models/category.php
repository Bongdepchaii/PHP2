<?php
class Category extends Model
{
    private $table = "category";
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
        $sql = "insert into $this->table (name, created_at) values (:name, :created_at)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'created_at' => $data['created_at']
        ]);
    }

    public function update($data = [], $id) {
        $sql = "update $this->table set name = :name, created_at = :created_at where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'created_at' => $data['created_at'],
            'id' => $id
        ]);
    }

    public function delete($id) {
        $sql = "delete from $this->table where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]);
    }
}

?>