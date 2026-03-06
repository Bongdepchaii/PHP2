    <?php
    class Booking extends Model
    {
        private $table = "booking";
        public function all()
        {
            $sql = "select * from $this->table order by id desc";
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
            $sql = "insert into $this->table (name, date, phone, time) VALUES (:name, :date, :phone, :time)";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            return $stmt->execute([
                'name' => $data['name'],
                'date' => $data['date'],
                'phone' => $data['phone'],
                'time' => $data['time'],
            ]);
        }

        public function update($data = [], $id) {
            $sql = "update $this->table set name = :name, date = :date, phone = :phone, time = :time where id = :id";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            return $stmt->execute([
                'name' => $data['name'],
                'date' => $data['date'],
                'phone' => $data['phone'],
                'time' => $data['time'],
                'id' => (int)$id
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