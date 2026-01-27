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
        <div class="d-flex justify-content-around">
            <h2>Thêm sản phẩm</h2>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">Tên sản phẩm
                <input type="text" name="name" placeholder="Nhập tên sản phẩm" class="form-control mt-2 p-2">
            </div>
            <div class="mb-3">Số lượng
                <input type="number" name="quantity" placeholder="Nhập số lượng sản phẩm" class="form-control mt-2 p-2">
            </div>
            <div class="mb-3">Giá bán
                <input type="number" name="price" placeholder="Nhập giá bán sản phẩm" class="form-control mt-2 p-2">
            </div>
            <div class="mb-3">Hình ảnh
                <input type="file" name="img" class="form-control mt-2 p-3">
            </div>
            <div class="mb-1">Mô tả
                <textarea col="5" rows="10" name="mota" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
            </div>
            <div class="d-flex flex-row-reverse">
                <a href="/product" class="ml-auto p-3">Quay lại danh sách</a>
            </div>
            <input type="submit" value="Thêm" class="btn btn-success form-control p-3">
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<style>
    div.main {
        max-width: 1100px;
    }
</style><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/products/add.blade.php ENDPATH**/ ?>