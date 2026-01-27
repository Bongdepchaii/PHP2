<html>
<head>
   <title><?= $title ?></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" ...>
</head>

<body>
   <div class="container mt-3 header">
      <nav class="navbar navbar-expand-lg navbar-light">
         <a class="navbar-brand" href="/home/index">Home</a>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
               <li class="nav-item active">
                  <a class="nav-link" href="/product">Sản phẩm</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/category">Danh mục</a>
               </li>
                              <li class="nav-item">
                  <a class="nav-link" href="/trademark">Thương hiệu</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="/user">Người dùng</a>
               </li>
            </ul>
         </div>
      </nav>
   </div>
   <div class="container mt-5 main">
      <a href="/product/add" class="btn btn-outline-dark mb-4 form-control p-2">Thêm sản phẩm</a>
      <table class="table">
         <thead>
            <tr>
               <th scope="col">ID</th>
               <th scope="col">Tên sản phẩm</th>
               <th scope="col">Giá</th>
               <th scope="col">Mô tả</th>
               <th scope="col">Ngày tạo</th>
               <th scope="col">Hành động</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($products as $item): ?>
               <tr>
                  <th scope="row"><?= $item['id'] ?></th>
                  <td><?= $item['name'] ?></td>
                  <td><?= $item['price'] ?></td>
                  <td><?= substr($item['mota'], 0, 80). '...' ?></td>
                  <td><?= $item['created_at'] ?></td>
                  <td><a href="/product/edit/<?= $item['id'] ?>" class="btn btn-primary">Sửa</a><a onclick="return confirm('Bạn chắc chắn có muốn xoá sản phẩm này?')" href="/product/delete/<?= $item['id'] ?>"  style="margin-left: 5px;" class="btn btn-danger">Xoá</a></td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
   </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<style>
   div.main {
      max-width: 1100px;
   }
</style><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/products/index.blade.php ENDPATH**/ ?>