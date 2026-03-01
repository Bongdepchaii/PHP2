<?php
class Cart extends Model
{
    private $table = "cart";

    // tim tat ca san pham trong gio hang cua user
    public function findByUser($userId)
    {
        $sql = "SELECT c.*, p.name as product_name, p.price as base_price, p.img, p.quantity as base_stock, 
                       v.id_color, v.id_rom, v.price as variant_price, col.name as color_name, r.name as rom_name, v.quantity as variant_stock
                FROM $this->table c 
                JOIN product p ON c.id_product = p.id 
                LEFT JOIN variant v ON c.id_variant = v.id
                LEFT JOIN color col ON v.id_color = col.id
                LEFT JOIN rom r ON v.id_rom = r.id
                WHERE c.id_user = :id_user";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute(['id_user' => $userId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as &$item) {
            if (!empty($item['id_variant'])) {
                $item['price'] = $item['variant_price'] > 0 ? $item['variant_price'] : $item['base_price'];
                $item['stock'] = $item['variant_stock'];
                // Check neu co ca color va ram se co giau , neu chi co 1 trong 2 thi se khong giau
                if (!empty($item['id_color']) && !empty($item['id_rom'])) {
                    $item['product_name'] .= " ({$item['color_name']}, {$item['rom_name']})";
                } else if (!empty($item['id_color'])) {
                    $item['product_name'] .= " ({$item['color_name']})";
                }
            } else {
                $item['price'] = $item['base_price'];
                $item['stock'] = $item['base_stock'];
            }
        }
        return $items;
    }

    // tim san pham trong gio hang
    public function findItem($userId, $productId, $variantId = null)
    {
        if ($variantId) {
            $sql = "SELECT * FROM $this->table WHERE id_user = :id_user AND id_product = :id_product AND id_variant = :id_variant";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            $stmt->execute([
                'id_user'    => $userId,
                'id_product' => $productId,
                'id_variant' => $variantId
            ]);
        } else {
            $sql = "SELECT * FROM $this->table WHERE id_user = :id_user AND id_product = :id_product AND id_variant IS NULL";
            $conn = $this->connect();
            $stmt =  $conn->prepare($sql);
            $stmt->execute([
                'id_user'    => $userId,
                'id_product' => $productId
            ]);
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $sql = "INSERT INTO $this->table (id_user, id_product, id_variant, quantity) VALUES (:id_user, :id_product, :id_variant, :quantity)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id_user'    => $data['id_user'],
            'id_product' => $data['id_product'],
            'id_variant' => $data['id_variant'] ?? null,
            'quantity'   => $data['quantity']
        ]);
    }

    public function updateQuantity($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = :quantity WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'quantity' => $quantity,
            'id'       => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function deleteByUser($userId)
    {
        $sql = "DELETE FROM $this->table WHERE id_user = :id_user";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id_user' => $userId]);
    }
}
