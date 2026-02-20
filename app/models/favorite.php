    <?php
class Favorite extends Model
{
    private $table = "favorite";
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
        $sql = "insert into $this->table (id_product, id_user, created_at) VALUES (:id_product, :id_user, :created_at)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id_product' => $data['id_product'],
            'id_user' => $data['id_user'],
            'created_at' => $data['created_at']
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

    public function getFavoritesByUserId($id_user)
    {
        $sql = "SELECT p.*, f.created_at as favorite_at, f.id as favorite_id
                FROM $this->table f
                JOIN product p ON f.id_product = p.id
                WHERE f.id_user = :id_user";
        
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function checkFavorite($userId, $productId)
    {
        $sql = "select * from $this->table where id_user = :id_user and id_product = :id_product";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id_user' => $userId,
            'id_product' => $productId
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}