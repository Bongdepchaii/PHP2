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
        $setParts = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            $setParts[] = "$key = :$key";
            $params[$key] = $value;
        }

        if (empty($setParts)) {
            return false; 
        }

        $sql = "update $this->table set " . implode(', ', $setParts) . " where id = :id";
        
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        
        return $stmt->execute($params);
    }

    // forgot password

    public function saveOtp($email, $otp, $expiry)
    {
        // Cột trong DB: otp (int), end_otp (time)
        $sql = "UPDATE $this->table SET otp = :otp, end_otp = :expiry WHERE email = :email";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'otp'    => $otp,
            'expiry' => $expiry,
            'email'  => $email,
        ]);
    }

    public function findByOtp($otp)
    {
        $sql = "SELECT * FROM $this->table WHERE otp = :otp";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['otp' => (int)$otp]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function clearOtp($id)
    {
        $sql = "UPDATE $this->table SET otp = NULL, end_otp = NULL WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
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