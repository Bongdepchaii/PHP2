<?php
    class Member extends Model
    {
        private $table = "member";
        public function all($page, $perPage)
        {
            $conn = $this->connect();
            $sql = "select * from $this->table LIMIT :offset, :perPage";
            $stmt =  $conn->prepare($sql);
            $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function search($keyword, $page = 1, $perPage = 9)
        {
            $conn = $this->connect();
            $sql = "select * from $this->table where name like :keyword or branch like :keyword or gen like :keyword or note like :keyword LIMIT :offset, :perPage";
            $stmt =  $conn->prepare($sql);
            $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
            $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
            $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTotalCount($keyword = "")
        {
            $conn = $this->connect();
            if ($keyword !== "") {
                $sql = "select count(*) as total from $this->table where name like :keyword or branch like :keyword or gen like :keyword or note like :keyword";
                $stmt =  $conn->prepare($sql);
                $stmt->execute(['keyword' => "%$keyword%"]);
            } else {
                $sql = "select count(*) as total from $this->table";
                $stmt =  $conn->prepare($sql);
                $stmt->execute([]);
            }
            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
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
            $sql = "insert into $this->table (name, gen, branch, birth, death, spouse, father_id, note, img) VALUES (:name, :gen, :branch, :birth, :death, :spouse, :father_id, :note, :img)";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            return $stmt->execute([
                'name' => $data['name'],
                'gen' => $data['gen'],
                'branch' => $data['branch'],
                'birth' => $data['birth'],
                'death' => $data['death'],
                'spouse' => $data['spouse'],
                'father_id' => $data['father_id'],
                'note' => $data['note'],
                'img' => $data['img'],
            ]);
        }

        public function update($data = [], $id) {
            $sql = "update $this->table set name = :name, gen = :gen, branch = :branch, birth = :birth, death = :death, spouse = :spouse, father_id = :father_id, note = :note, img = :img where id = :id";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            return $stmt->execute([
                 'name' => $data['name'],
                'gen' => $data['gen'],
                'branch' => $data['branch'],
                'birth' => $data['birth'],
                'death' => $data['death'],
                'spouse' => $data['spouse'],
                'father_id' => $data['father_id'],
                'note' => $data['note'],
                'img' => $data['img'],
                'id' => (int)$id,
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