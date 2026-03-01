<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top shadow-sm">
    <div class="container">
      <a href="/"><img src="https://thanhbui.click/wp-content/uploads/2025/09/tbs-removebg-preview.png" alt="" style="height: 70px;"></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>

        <div class="d-flex align-items-center gap-3">
            <form class="d-flex" role="search" method="GET" action="/home/index">
              <input class="form-control form-control-sm me-2" type="search" name="q"
                     placeholder="Tìm kiếm sản phẩm..."
                     value="{{ $_GET['q'] ?? '' }}" />
              {{-- <button class="btn btn-outline-primary btn-sm" type="submit"><i class="fas fa-search"></i></button> --}}
            </form>

            @if(isset($_SESSION['user_id']))
                    @php
                        $cartCount = 0;
                        try {
                            if (class_exists('Model')) {
                                $db = new class extends Model {
                                    public function getCartCount($userId) {
                                        $stmt = $this->connect()->prepare("SELECT SUM(quantity) FROM cart WHERE id_user = ?");
                                        $stmt->execute([$userId]);
                                        return $stmt->fetchColumn() ?: 0;
                                    }
                                };
                                $cartCount = $db->getCartCount($_SESSION['user_id']);
                            }
                        } catch (Exception $e) {}
                    @endphp
                    <a href="/cart" class="position-relative text-dark text-decoration-none me-2">
                        <i class="fas fa-shopping-cart fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ $cartCount }}
                        </span> 
                    </a>
                
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <div class="avatar-image avatar-sm me-2">
                             <img src="https://ui-avatars.com/api/?name={{ urlencode($_SESSION['user_name'] ?? 'User') }}&background=random" class="rounded-circle" style="width: 32px; height: 32px;">
                        </div>
                        <span class="fw-semibold small d-none d-md-block">{{ $_SESSION['user_name'] ?? 'User' }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item mt-1" href="/auth/profile">Hồ sơ cá nhân</a></li>
                        <li><a class="dropdown-item mt-1" href="/user/favorite">Yêu thích sản phẩm</a></li>
                        <li><a class="dropdown-item mt-1" href="/order/history">Đơn hàng đã đặt</a></li>
                        @if($_SESSION['role'] == 'admin')
                        <li><a class="dropdown-item mt-1" href="/product">Quản lý</a></li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/auth/logout">Đăng xuất</a></li>
                    </ul>
                </div>
            @else
                <div class="d-flex gap-2">
                    <a href="/auth/login" class="btn-sm fw-semibold"><i class="fas fa-user link-body-emphasis"></i></a>
                </div>
            @endif
        </div>
      </div>
    </div>
  </nav>