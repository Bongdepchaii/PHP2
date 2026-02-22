@php
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $activeTab = $activeTab ?? (
        str_contains($currentPath, '/user/favorites') ? 'favorites' :
        (str_contains($currentPath, '/order') ? 'orders' : 'profile')
    );
    $userName  = $user['name'] ?? ($_SESSION['user_name'] ?? 'Người dùng');
    $userEmail = $user['email'] ?? '';
    $initials  = strtoupper(mb_substr($userName, 0, 1));
@endphp

<div class="col-12 col-md-3 mb-4">
    <div class="card border-0 shadow-sm text-center p-3 mb-3">
        {{-- Avatar --}}
        <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
             style="width:80px;height:80px;font-size:2rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
            {{ $initials }}
        </div>
        <h6 class="fw-bold mb-0">{{ $userName }}</h6>
        <small class="text-muted">{{ $userEmail }}</small>
    </div>

    <div class="list-group shadow-sm">
        <a href="/auth/profile"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $activeTab === 'profile' ? 'active' : '' }}">
            <i class="fas fa-user"></i> Tài khoản của tôi
        </a>
        <a href="/user/favorite"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $activeTab === 'favorites' ? 'active' : '' }}">
            <i class="fas fa-heart"></i> Sản phẩm yêu thích
        </a>
        <a href="/auth/profile#orders"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 {{ $activeTab === 'orders' ? 'active' : '' }}">
            <i class="fas fa-box"></i> Đơn hàng của tôi
        </a>
        <a href="/auth/logout"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 text-danger"
           onclick="return confirm('Đăng xuất?')">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
    </div>
</div>
