
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<?php
$statusMap = [
    'pending'   => ['label' => 'Chờ xử lý',  'color' => 'warning'],
    'confirmed' => ['label' => 'Đã xác nhận','color' => 'info'],
    'shipping'  => ['label' => 'Đang giao',  'color' => 'primary'],
    'done'      => ['label' => 'Hoàn thành', 'color' => 'success'],
    'cancelled' => ['label' => 'Đã hủy',     'color' => 'danger'],
];
$s = $statusMap[$order['status']] ?? ['label' => $order['status'], 'color' => 'secondary'];
?>

<div class="d-flex justify-content-between align-items-center mb-4 ms-4 mt-5">
    <h4 class="fw-bold mb-0">Đơn hàng #<?php echo e($order['id']); ?></h4>
    <a href="/order" class="btn btn-outline-secondary btn-sm me-4">
        <i class="fas fa-arrow-left me-1"></i>Quay lại
    </a>
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-bold">Thông tin giao hàng</div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6"><span class="text-muted">Người nhận:</span> <strong><?php echo e($order['receiver']); ?></strong></div>
                    <div class="col-12"><span class="text-muted">Điện thoại:</span> <?php echo e($order['phone']); ?></div>
                    <div class="col-12"><span class="text-muted">Địa chỉ:</span> <?php echo e($order['address']); ?></div>
                    <?php if($order['note']): ?><div class="col-12"><span class="text-muted">Ghi chú:</span> <?php echo e($order['note']); ?></div><?php endif; ?>
                    <div class="col-12"><span class="text-muted">Ngày đặt:</span> <?php echo e(date('d/m/Y H:i', strtotime($order['created_at']))); ?></div>
                    <div class="col-12"><span class="text-muted">Trạng thái:</span> <span class="badge bg-<?php echo e($s['color']); ?>"><?php echo e($s['label']); ?></span></div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Sản phẩm</div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $order['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <span class="fw-semibold"><?php echo e($item['product_name']); ?></span>
                        <span class="text-muted ms-2">x<?php echo e($item['quantity']); ?></span>
                    </div>
                    <span class="fw-bold"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>đ</span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between text-muted">
                    <span>Tạm tính:</span>
                    <span><?php echo e(number_format($order['subtotal'], 0, ',', '.')); ?>đ</span>
                </div>
                <?php if($order['discount'] > 0): ?>
                <div class="d-flex justify-content-between text-danger">
                    <span>Giảm giá <?php echo e($order['id_voucher'] ? '('.$order['id_voucher'].')' : ''); ?>:</span>
                    <span>- <?php echo e(number_format($order['discount'], 0, ',', '.')); ?>đ</span>
                </div>
                <?php endif; ?>
                <div class="d-flex justify-content-between fw-bold fs-6 border-top mt-1 pt-2">
                    <span>Tổng thanh toán:</span>
                    <span class="text-primary"><?php echo e(number_format($order['total'], 0, ',', '.')); ?>đ</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/order/detail.blade.php ENDPATH**/ ?>