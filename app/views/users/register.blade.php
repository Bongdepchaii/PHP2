<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" ...>
    <title><?= $title ?></title>
</head>
<body>
    <div class="container mt-5">
        <form action="" style="max-width: 500px; margin: 0px auto">
            <img src="../../images/img/photos/LogoTBS.png" alt="Logo">
            <input type="text" class="form-control mt-5" placeholder="Vui lòng nhập email hoặc tên đăng nhập">
            <input type="submit" value="Quên mật khẩu!" class="form-control btn btn-primary mt-2">
            <a href="/login">Quay lại trang đăng nhập</a>
        </form>
    </div>    
</body>
</html>

<style scoped>
    img{
        display: block;
        margin: 0px auto 20px auto;
        width: 150px;
    }
</style>