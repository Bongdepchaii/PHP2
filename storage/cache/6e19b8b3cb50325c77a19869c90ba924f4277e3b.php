
<?php $__env->startSection('title', 'Đơn hàng của tôi'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">

    
    <?php echo $__env->make('layouts.includes.user_nav', ['user' => $user ?? [], 'activeTab' => 'orders'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="col-12 col-md-9">

        <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <h5 class="fw-bold mb-4"><i class="fas fa-box me-2 text-warning"></i>Đơn hàng của tôi</h5>

        <?php
        $statusMap = [
            'pending'   => ['label' => 'Chờ xử lý',   'color' => 'warning',   'icon' => 'clock'],
            'confirmed' => ['label' => 'Đã xác nhận',  'color' => 'info',      'icon' => 'check-circle'],
            'shipping'  => ['label' => 'Đang giao',    'color' => 'primary',   'icon' => 'truck'],
            'done'      => ['label' => 'Hoàn thành',   'color' => 'success',   'icon' => 'check-double'],
            'cancelled' => ['label' => 'Đã hủy',       'color' => 'danger',    'icon' => 'times-circle'],
        ];
        ?>

        <?php if(isset($orders) && count($orders) > 0): ?>

            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $s = $statusMap[$order['status']] ?? ['label' => $order['status'], 'color' => 'secondary', 'icon' => 'circle']; ?>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <div>
                        <span class="fw-bold">Đơn #<?php echo e($order['id']); ?></span>
                        <small class="text-muted ms-2"><?php echo e(date('d/m/Y H:i', strtotime($order['created_at']))); ?></small>
                    </div>
                    <span class="badge bg-<?php echo e($s['color']); ?> px-3 py-2">
                        <i class="fas fa-<?php echo e($s['icon']); ?> me-1"></i><?php echo e($s['label']); ?>

                    </span>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-8">
                            <small class="text-muted"><i class="fas fa-user me-1"></i><?php echo e($order['receiver']); ?> — <?php echo e($order['phone']); ?></small><br>
                            <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i><?php echo e($order['address']); ?></small>
                            <?php if($order['note']): ?>
                            <br><small class="text-muted"><i class="fas fa-sticky-note me-1"></i><?php echo e($order['note']); ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <?php if($order['discount'] > 0): ?>
                            <div class="text-muted text-decoration-line-through small"><?php echo e(number_format($order['subtotal'], 0, ',', '.')); ?>đ</div>
                            <div class="small text-danger">Giảm: <?php echo e(number_format($order['discount'], 0, ',', '.')); ?>đ</div>
                            <?php endif; ?>
                            <div class="fw-bold text-primary fs-6"><?php echo e(number_format($order['total'], 0, ',', '.')); ?>đ</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex gap-2 flex-wrap py-2">
                    
                    <a href="/order/success/<?php echo e($order['id']); ?>" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-eye me-1"></i>Xem chi tiết
                    </a>
                    
                    <?php if($order['status'] === 'pending'): ?>
                    <a href="/order/cancel/<?php echo e($order['id']); ?>"
                       class="btn btn-sm btn-outline-danger"
                       onclick="return confirm('Bạn có chắc muốn hủy đơn hàng #<?php echo e($order['id']); ?>?')">
                        <i class="fas fa-times me-1"></i>Hủy đơn
                    </a>
                    <?php endif; ?>
                    
                    <?php if(in_array($order['status'], ['done', 'cancelled'])): ?>
                    <a href="/order/reorder/<?php echo e($order['id']); ?>"
                       class="btn btn-sm btn-outline-primary"
                       onclick="return confirm('Thêm các sản phẩm này vào giỏ hàng?')">
                        <i class="fas fa-redo me-1"></i>Mua lại
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-box-open fs-1 text-muted d-block mb-3"></i>
                    <h5 class="text-muted">Bạn chưa có đơn hàng nào</h5>
                    <a href="/" class="btn btn-primary mt-2 px-4">Mua sắm ngay</a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/order/history.blade.php ENDPATH**/ ?>