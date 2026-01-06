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



// Connect database
$db_utils = new DB_UTILS();
$sql = "SELECT * FROM student";
$student = $db_utils->getAll($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="cdn.jsdelivr.net" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Demo php 2</title>
</head>
<body>

<!-- Add Student -->
<h1>Thêm Sinh Viên</h1>
<form action="" method="POST">
    <input type="hidden" name="id" value="">
    <input type="text" name="name" placeholder="Enter The Name">
    <input type="number" name="point" placeholder="Enter The Point"> 
    <input type="submit" name="submit" >
</form>

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
    <tr <?php foreach ($student as $s): ?>>
      <th scope="row"><?php echo $s['id'] ?></th>
      <td><?php echo $s ['name'] ?></td>
      <td><?php echo $s ['point'] ?></td>
      <td> <button class="btn btn Primary">Sửa</button>
      <button class="btn btn danger">Xoá</button></td>
    </tr <?php endforeach; ?>>
  </tbody>
</table>

        <script src="cdn.jsdelivr.net" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 10px;
}
</style>