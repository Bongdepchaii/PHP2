
<?php $__env->startSection('title', 'Đặt hàng thành công'); ?>
<?php $__env->startSection('content'); ?>

<div class="row justify-content-center">
  <div class="col-lg-7">

    
    <div class="text-center mb-4">
      <div class="mb-3">
        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
      </div>
      <h4 class="fw-bold text-success">Đặt hàng thành công!</h4>
      <p class="text-muted">Cảm ơn bạn đã mua hàng. Đơn hàng <strong>#<?php echo e($order['id']); ?></strong> đang được xử lý.</p>
    </div>

    
    <div class="card mb-3">
      <div class="card-header"><strong>Thông tin giao hàng</strong></div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-md-6">
            <span class="text-muted">Người nhận:</span>
            <span class="fw-semibold ms-1"><?php echo e($order['receiver']); ?></span>
          </div>
          <div class="col-md-6">
            <span class="text-muted">Điện thoại:</span>
            <span class="fw-semibold ms-1"><?php echo e($order['phone']); ?></span>
          </div>
          <div class="col-12">
            <span class="text-muted">Địa chỉ:</span>
            <span class="ms-1"><?php echo e($order['address']); ?></span>
          </div>
          <?php if($order['note']): ?>
          <div class="col-12">
            <span class="text-muted">Ghi chú:</span>
            <span class="ms-1"><?php echo e($order['note']); ?></span>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    
    <div class="card mb-3">
      <div class="card-header"><strong>Sản phẩm đã đặt</strong></div>
      <ul class="list-group list-group-flush">
        <?php $__currentLoopData = $order['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item d-flex justify-content-between">
          <span><?php echo e($item['product_name']); ?> <span class="text-muted">x<?php echo e($item['quantity']); ?></span></span>
          <span class="fw-semibold"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>đ</span>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
      <div class="card-footer">
        <div class="d-flex justify-content-between">
          <span class="text-muted">Tạm tính:</span>
          <span><?php echo e(number_format($order['subtotal'], 0, ',', '.')); ?>đ</span>
        </div>
        <?php if($order['discount'] > 0): ?>
        <div class="d-flex justify-content-between text-danger">
          <span>Giảm giá (<?php echo e($order['id_voucher']); ?>):</span>
          <span>- <?php echo e(number_format($order['discount'], 0, ',', '.')); ?>đ</span>
        </div>
        <?php endif; ?>
        <div class="d-flex justify-content-between fw-bold fs-6 mt-1 border-top pt-2">
          <span>Tổng thanh toán:</span>
          <span class="text-primary"><?php echo e(number_format($order['total'], 0, ',', '.')); ?>đ</span>
        </div>
      </div>
    </div>

    <div class="d-flex gap-2 justify-content-center">
      <a href="/" class="btn btn-primary">
        <i class="fas fa-home me-1"></i>Tiếp tục mua sắm
      </a>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/order/success.blade.php ENDPATH**/ ?>