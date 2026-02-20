
<?php $__env->startSection('title', 'Giỏ hàng'); ?>
<?php $__env->startSection('content'); ?>

<div class="container py-4">
    <h4 class="fw-bold mb-4">GIỎ HÀNG (<span class="text-primary"><?php echo e(count($cart)); ?></span> sản phẩm)</h4>
    
    <div class="row g-4">
        <div class="col-12 col-lg-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <?php if(empty($cart)): ?>
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="Empty Cart" style="width: 150px;" class="mb-3 opacity-50">
                            <h5 class="text-muted">Giỏ hàng của bạn đang trống</h5>
                            <a href="/" class="btn btn-primary mt-3 px-4">Tiếp tục mua sắm</a>
                        </div>
                    <?php else: ?>
                        <div class="d-none d-md-flex bg-light p-3 fw-bold text-muted small border-bottom">
                            <div style="flex: 2;">SẢN PHẨM</div>
                            <div style="flex: 1;" class="text-center">ĐƠN GIÁ</div>
                            <div style="flex: 1;" class="text-center">SỐ LƯỢNG</div>
                            <div style="flex: 1;" class="text-end">THÀNH TIỀN</div>
                        </div>

                        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $images = json_decode($item['img'], true);
                            $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                            $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://via.placeholder.com/80";
                        ?>
                        <div class="p-3 border-bottom align-items-center d-flex flex-column flex-md-row">
                            <div class="d-flex align-items-center w-100" style="flex: 2;">
                                <img src="<?php echo e($imgSrc); ?>" class="rounded-2 border" alt="<?php echo e($item['product_name']); ?>" style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold"><?php echo e($item['product_name']); ?></h6>
                                    <!-- <p class="small text-muted mb-0">Color/Info if available</p> -->
                                    <a href="/cart/delete/<?php echo e($item['id']); ?>" class="btn btn-link btn-sm p-0 text-danger text-decoration-none mt-1" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                                </div>
                            </div>
                            <div class="text-center w-100 mt-2 mt-md-0" style="flex: 1;">
                                <span class="fw-semibold"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</span>
                            </div>
                            <div class="d-flex justify-content-center w-100 mt-2 mt-md-0" style="flex: 1;">
                                <div class="input-group input-group-sm" style="width: 100px;">
                                    <button class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="<?php echo e($item['quantity']); ?>">
                                    <button class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="text-end w-100 mt-2 mt-md-0" style="flex: 1;">
                                <span class="fw-bold text-primary"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>đ</span>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Xử lý JS cho nút tăng giảm số lượng nếu cần
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/cart/index.blade.php ENDPATH**/ ?>