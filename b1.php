<?php

require_once './Database/db_utils.php';
// Code sum
function sum($a, $b)
{
    return $a + $b;
};
sum(5, 10);
echo "</br>";

// Code class construct
class student
{
    public $id;
    public $name;
    public $point;
    public function __construct($id, $name, $point)
    {
        $this->id = $id;
        $this->name = $name;
        $this->point = $point;
    }
    public function show()
    {
        echo "MSSV: $this->id ";
        echo "Name: $this->name ";
        echo "Point: $this->point </br>";
    }

    public function xeploai()
    {
        if ($this->point >= 8.5) {
            echo "Perfect </br>";
        } else if ($this->point >= 6.5) {
            echo "High </br>";
        } else if ($this->point >= 5) {
            echo "Medium </br>";
        } else if ($this->point <= 3) {
            echo "Low point </br>";
        };
    }
};
$student = new student("PS46198", "Bui Trong Thanh", "8");
$student2 = new student("PS46522", "Truong My Ly", "6");

// Student 1
$student->show();
$student->xeploai();

// student 2
$student2->show();
$student2->xeploai();

// Message
$message = "";

// Connect database
$db_utils = new DB_UTILS();
$sql = "SELECT * FROM student";
$student = $db_utils->getAll($sql);

// add student 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $point = $_POST['point'];
    $sql = "insert into student (name, point) values ( ?, ? )";
    $db_utils->execute($sql, [$name, $point]);
    // header("Location: b1.php");
    $message = "Add sinh vien thành công!";
}

// update student
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $point = $_POST['point'];

    $sql = "UPDATE student SET name = ?, point = ? WHERE id = ?";
    $db_utils->execute($sql, [$name, $point, $id]);
    header("Location: b1.php");
    exit;
}

// Remove student 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "delete from student where id = ?";
    $db_utils->execute($sql, [$id]);
    $message = "Remove sinh vien thành công!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Demo php 2</title>
</head>

<body>
    <div class="container">



        <!-- Add Student -->
        <h1>Thêm Sinh Viên</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="">
            <input type="text" name="name" placeholder="Enter The Name">
            <input type="number" name="point" placeholder="Enter The Point">
            <input type="submit" name="submit">
        </form>
        <span><?php echo $message ?></span>

        <!-- List Student -->
        <h1>Danh Sách Sinh Viên</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">MSSV</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Điểm</th>
                    <th scope="col">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student as $s): ?>
                    <tr>
                        <th scope="row"><?php echo $s['id'] ?></th>
                        <td><?php echo $s['name'] ?></td>
                        <td><?php echo $s['point'] ?></td>
                        <td> <button class="btn btn primary" onclick="openEditModal('<?php echo $s['id'] ?>', '<?php echo $s['name'] ?>', '<?php echo $s['point'] ?>')">Sửa</button>
                            <a class="btn btn danger" href="?id=<?php echo $s['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá sinh viên này không?')">Xoá</a>
                        </td>
                    </tr <?php endforeach; ?>>
            </tbody>
        </table>

        <div id="editModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4);">
            <div style="background:#fff; width:300px; margin:100px auto; padding:20px;">
                <h3>Sửa sinh viên</h3>

                <form method="POST">
                    <input type="hidden" name="id" id="edit_id">

                    <input type="text" name="name" id="edit_name" placeholder="Tên" required>
                    <br><br>

                    <input type="number" name="point" id="edit_point" placeholder="Điểm" required>
                    <br><br>

                    <button class="btn btn primary]" type="submit" name="update">Lưu</button>
                    <button class="btn btn danger" type="button" onclick="closeEditModal()">Huỷ</button>
                </form>
            </div>
        </div>

    </div>
    <script src="cdn.jsdelivr.net" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function openEditModal(id, name, point) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_point').value = point;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>

</html>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px;
    }

    h1{
        font-size: 1.5rem;
        font-family: 'Times New Roman', Times, serif;
    }
</style>