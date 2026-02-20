<?php
class Voucher extends Model
{
    private $table = "voucher";
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
        $sql = "insert into $this->table (id_voucher, name, value, quanity, status, created_at, end_date) values(:id_voucher, :name, :value, :quanity, :status, :created_at, :end_date)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id_voucher' => $data['id_voucher'],
            'name' => $data['name'],
            'value' => $data['value'],
            'quanity' => $data['quanity'],
            'status' => $data['status'],
            'created_at' => $data['created_at'],
            'end_date' => $data['end_date']
        ]);
    }

    public function update($data = [], $id) {
        $setParts = [];
        $params = ['id_key' => $id]; // Use a unique param name to avoid conflict

        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
            $params[$key] = $value;
        }

        if (empty($setParts)) {
            return false; 
        }

        // Assuming id_voucher is the PK
        $sql = "update $this->table set " . implode(', ', $setParts) . " where id_voucher = :id_key";
        
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        
        return $stmt->execute($params);
    }

    public function delete($id) {
        $sql = "delete from $this->table where id_voucher = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]);
    }
}
?>
