
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<?php
$statusList = [
    'all'       => ['label' => 'Tất cả',       'icon' => 'list',          'color' => 'secondary'],
    'pending'   => ['label' => 'Chờ xử lý',    'icon' => 'clock',         'color' => 'warning'],
    'confirmed' => ['label' => 'Đã xác nhận',  'icon' => 'check-circle',  'color' => 'info'],
    'shipping'  => ['label' => 'Đang giao',    'icon' => 'truck',         'color' => 'primary'],
    'done'      => ['label' => 'Hoàn thành',   'icon' => 'check-double',  'color' => 'success'],
    'cancelled' => ['label' => 'Đã hủy',       'icon' => 'times-circle',  'color' => 'danger'],
];

// Nút chuyển trạng thái tiếp theo
$nextStatus = [
    'pending'   => 'confirmed',
    'confirmed' => 'shipping',
    'shipping'  => 'done',
];
?>

<div class="d-flex justify-content-between align-items-center mb-4 mt-5 ms-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-clipboard-list me-2"></i>Quản lý đơn hàng</h4>
</div>

<ul class="nav nav-pills mb-4 gap-1 flex-wrap ms-4">
    <?php $__currentLoopData = $statusList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $count = ($key === 'all') ? array_sum($counts) : ($counts[$key] ?? 0);
        $href  = ($key === 'all') ? '/order/index' : '/order/index?status=' . $key;
        $isActive = ($key === 'all' && !$activeStatus) || ($key === $activeStatus);
    ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e($isActive ? 'active' : 'text-dark bg-light'); ?>" href="<?php echo e($href); ?>">
            <i class="fas fa-<?php echo e($info['icon']); ?> me-1"></i>
            <?php echo e($info['label']); ?>

            <span class="badge <?php echo e($isActive ? 'bg-white text-dark' : 'bg-'.$info['color']); ?> ms-1"><?php echo e($count); ?></span>
        </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

<?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php if(count($orders) > 0): ?>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ giao</th>
                    <th class="text-end">Tổng tiền</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $s    = $statusList[$order['status']] ?? ['label' => $order['status'], 'icon' => 'circle', 'color' => 'secondary'];
                    $next = $nextStatus[$order['status']] ?? null;
                    $nextInfo = $next ? $statusList[$next] : null;
                ?>
                <tr>
                    <td>
                        <span class="fw-bold">#<?php echo e($order['id']); ?></span>
                        <br><small class="text-muted"><?php echo e(date('d/m/Y H:i', strtotime($order['created_at']))); ?></small>
                    </td>
                    <td>
                        <span class="fw-semibold"><?php echo e($order['user_name']); ?></span>
                        <br><small class="text-muted"><?php echo e($order['user_email']); ?></small>
                        <br><small><?php echo e($order['receiver']); ?> — <?php echo e($order['phone']); ?></small>
                    </td>
                    <td>
                        <small><?php echo e($order['address']); ?></small>
                        <?php if($order['note']): ?>
                        <br><small class="text-muted fst-italic"><?php echo e($order['note']); ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?php if($order['discount'] > 0): ?>
                        <small class="text-muted text-decoration-line-through d-block"><?php echo e(number_format($order['subtotal'], 0, ',', '.')); ?>đ</small>
                        <?php endif; ?>
                        <span class="fw-bold text-primary"><?php echo e(number_format($order['total'], 0, ',', '.')); ?>đ</span>
                        <?php if($order['id_voucher']): ?>
                        <br><small class="badge bg-light text-success border"><?php echo e($order['id_voucher']); ?></small>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-<?php echo e($s['color']); ?> px-2 py-1">
                            <i class="fas fa-<?php echo e($s['icon']); ?> me-1"></i><?php echo e($s['label']); ?>

                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            
                            <a href="/order/detail/<?php echo e($order['id']); ?>"
                               class="btn btn-sm btn-outline-secondary" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <?php if($nextInfo): ?>
                            <form action="/order/updateStatus/<?php echo e($order['id']); ?>" method="POST" class="d-inline">
                                <input type="hidden" name="status" value="<?php echo e($next); ?>">
                                <input type="hidden" name="from_status" value="<?php echo e($activeStatus); ?>">
                                <button type="submit" class="btn btn-sm btn-<?php echo e($nextInfo['color']); ?>"
                                        title="<?php echo e($nextInfo['label']); ?>"
                                        onclick="return confirm('Chuyển sang: <?php echo e($nextInfo['label']); ?>?')">
                                    <i class="fas fa-arrow-right me-1"></i><?php echo e($nextInfo['label']); ?>

                                </button>
                            </form>
                            <?php endif; ?>
                            
                            <?php if(in_array($order['status'], ['pending', 'confirmed'])): ?>
                            <form action="/order/updateStatus/<?php echo e($order['id']); ?>" method="POST" class="d-inline">
                                <input type="hidden" name="status" value="cancelled">
                                <input type="hidden" name="from_status" value="<?php echo e($activeStatus); ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Hủy đơn #<?php echo e($order['id']); ?>?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5 text-muted">
        <i class="fas fa-inbox fs-1 d-block mb-3"></i>
        Không có đơn hàng nào trong mục này
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/order/index.blade.php ENDPATH**/ ?>