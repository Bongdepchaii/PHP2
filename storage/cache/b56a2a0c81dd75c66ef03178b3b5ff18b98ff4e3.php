 <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="/">TBS</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              Quản lý
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/product">Sản phẩm</a></li>
              <li><a class="dropdown-item" href="/category">Danh mục</a></li>
              <li><a class="dropdown-item" href="/trademark">Thương hiệu</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/user">Người dùng</a></li>
            </ul>
          </li>
        </ul>

        <form class="d-flex" role="">
          <input class="form-control me-2" type="search" placeholder="Aa" />
          <button class="btn btn-outline-primary" type="submit">Tìm</button>
        </form>
        <a href="/login" class="btn btn-primary ms-3">Đăng nhập</a>
        <a href="/login" class="btn btn-danger ms-2">Giỏ hàng</a>
      </div>
    </div>
  </nav><?php /**PATH C:\xampp\htdocs\PHP2\app\views/layouts/includes/header.blade.php ENDPATH**/ ?>