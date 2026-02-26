<?php
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $activeTab = $activeTab ?? (
        str_contains($currentPath, '/user/favorite') ? 'favorites' :
        (str_contains($currentPath, '/order/history') ? 'orders' : 'profile')
    );
    $userName  = $user['name'] ?? ($_SESSION['user_name'] ?? 'Người dùng');
    $userEmail = $user['email'] ?? '';
    $initials  = strtoupper(mb_substr($userName, 0, 1));
?>

<div class="col-12 col-md-3 mb-4">
    <div class="card border-0 shadow-sm text-center p-3 mb-3">
        
        <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
             style="width:80px;height:80px;font-size:2rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);">
            <?php echo e($initials); ?>

        </div>
        <h6 class="fw-bold mb-0"><?php echo e($userName); ?></h6>
        <small class="text-muted"><?php echo e($userEmail); ?></small>
    </div>

    <div class="list-group shadow-sm">
        <a href="/auth/profile"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?php echo e($activeTab === 'profile' ? 'active' : ''); ?>">
            <i class="fas fa-user"></i> Tài khoản của tôi
        </a>
        <a href="/user/favorite"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?php echo e($activeTab === 'favorites' ? 'active' : ''); ?>">
            <i class="fas fa-heart"></i> Sản phẩm yêu thích
        </a>
        <a href="/order/history"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 <?php echo e($activeTab === 'orders' ? 'active' : ''); ?>">
            <i class="fas fa-box"></i> Đơn hàng của tôi
        </a>
        <a href="/auth/logout"
           class="list-group-item list-group-item-action d-flex align-items-center gap-2 text-danger"
           onclick="return confirm('Đăng xuất?')">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
        </a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/includes/user_nav.blade.php ENDPATH**/ ?>