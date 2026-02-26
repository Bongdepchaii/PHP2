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
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        
        return $stmt->execute($data);
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
        // cot trong DB: otp (int), end_otp (time)
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

    // tim kiem + phan trang
    public function search($keyword = '', $page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $conn   = $this->connect();
        if ($keyword) {
            $sql  = "SELECT * FROM {$this->table} WHERE name LIKE :kw OR email LIKE :kw2 ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':kw',     '%' . $keyword . '%');
            $stmt->bindValue(':kw2',    '%' . $keyword . '%');
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

    public function countSearch($keyword = '')
    {
        $conn = $this->connect();
        if ($keyword) {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table} WHERE name LIKE :kw OR email LIKE :kw2";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':kw' => '%' . $keyword . '%', ':kw2' => '%' . $keyword . '%']);
        } else {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0;
    }

    public function findByGoogleId($google_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE google_id = :google_id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['google_id' => $google_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>