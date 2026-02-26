<?php
class Contact extends Model
{
    private $table = "contact";

    // lay tat ca lien he
    public function all()
    {
        $sql  = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // tim kiem + phan trang
    public function search($keyword = '', $page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $conn   = $this->connect();
        if ($keyword) {
            $sql  = "SELECT * FROM {$this->table}
                     WHERE full_name LIKE :kw OR email LIKE :kw2 OR subject LIKE :kw3
                     ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':kw',     '%' . $keyword . '%');
            $stmt->bindValue(':kw2',    '%' . $keyword . '%');
            $stmt->bindValue(':kw3',    '%' . $keyword . '%');
            $stmt->bindValue(':limit',  (int)$perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset,  PDO::PARAM_INT);
        } else {
            $sql  = "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':limit',  (int)$perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset,  PDO::PARAM_INT);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countSearch($keyword = '')
    {
        $conn = $this->connect();
        if ($keyword) {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table}
                     WHERE full_name LIKE :kw OR email LIKE :kw2 OR subject LIKE :kw3";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':kw' => '%'.$keyword.'%', ':kw2' => '%'.$keyword.'%', ':kw3' => '%'.$keyword.'%']);
        } else {
            $sql  = "SELECT COUNT(*) as cnt FROM {$this->table}";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0;
    }

    public function find($id)
    {
        $sql  = "SELECT * FROM {$this->table} WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // tao lien he moi
    public function create($data = [])
    {
        $sql  = "INSERT INTO {$this->table} (full_name, email, phone, subject, message, created_at)
                 VALUES (:full_name, :email, :phone, :subject, :message, :created_at)";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'full_name'  => $data['full_name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'subject'    => $data['subject'],
            'message'    => $data['message'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function delete($id)
    {
        $sql  = "DELETE FROM {$this->table} WHERE id = :id";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // lay email tat ca admin
    public function getAdminEmails()
    {
        $sql  = "SELECT email FROM user WHERE role = 'admin'";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'email');
    }
}
?>