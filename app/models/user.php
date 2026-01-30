<?php
class User extends Model
{
    private $table = "user";
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

    public function findByEmail($email)
    {
        $sql = "select * from $this->table where email = :email";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'email' => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $sql = "insert into $this->table (username, password, email, name, sex, age, address, role, created_at) values(:username, :password, :email, :name, :sex, :age, :address, :role, :created_at)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'username' => $data['username'],
            'password' => $data['password'],
            'email' => $data['email'],
            'name' => $data['name'],
            'sex' => $data['sex'],
            'age' => $data['age'],
            'address' => $data['address'],
            'role' => $data['role'],
            'created_at' => $data['created_at'],
        ]);
    }

    public function update($data = [], $id) {
        $sql = "update $this->table set username = :username, email = :email, name = :name, sex = :sex, age = :age, address = :address, role = :role, created_at = :created_at";
        if (!empty($data['password'])) {
            $sql .= ", password = :password";
        }
        $sql .= " where id = :id";
        
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        
        $params = [
            'username' => $data['username'],
            'email' => $data['email'],
            'name' => $data['name'],
            'sex' => $data['sex'],
            'age' => $data['age'],
            'address' => $data['address'],
            'role' => $data['role'],
            'created_at' => $data['created_at'],
            'id' => $id
        ];
        
        if (!empty($data['password'])) {
            $params['password'] = $data['password'];
        }
        
        return $stmt->execute($params);
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