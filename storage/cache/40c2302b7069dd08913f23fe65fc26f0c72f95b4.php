
<?php $__env->startSection('title', 'Trang chủ'); ?>
<?php $__env->startSection('content'); ?>

<div class="row g-3">
    <!-- Product Card -->
    <?php
    $catMap = array_column($categories, 'name', 'id');
    ?>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0">
            <?php
                $images = json_decode($item['img'], true);
                $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $item['id'];
            ?>
            <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                <img src="<?php echo e($imgSrc); ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="<?php echo e($item['name']); ?>" style="object-fit: cover;">
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title mb-1"><?php echo e($item['name']); ?></h5>
                    <span class="badge text-bg-primary"><?php echo e($catMap[$item['id_category']]); ?></span>
                </div>
                <p class="card-text text-muted small mb-2"><?php echo e(substr($item['mota'], 0, 80) . "..."); ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-semibold"><?php echo e($item['price']); ?></div>
                    <a href="#" class="btn btn-sm btn-outline-primary">Mua ngay</a>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/home/index.blade.php ENDPATH**/ ?>