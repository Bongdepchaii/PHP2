
<?php $__env->startSection('title', 'Quản lý danh mục'); ?>
<?php $__env->startSection('content'); ?>

<div class="row g-3">
    <!-- Product Card -->
             <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card h-100 shadow-sm">
            <img src="https://picsum.photos/600/400?random=1" class="card-img-top" alt="Product">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title mb-1"></h5>
                    <span class="badge text-bg-primary">Máy ảnh</span>
                </div>
                <p class="card-text text-muted small mb-2"><?php echo e(substr($item['mota'], 0, 80) . "..."); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-semibold"><?php echo e($item['price']); ?></div>
                    <a href="#" class="btn btn-sm btn-outline-primary">Xem</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    // alert("hello world")
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2\app\views/home/index.blade.php ENDPATH**/ ?>