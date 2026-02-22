
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <!-- Breadcrumb (Optional) -->
    <div class="col-12 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/home">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($product['name']); ?></li>
            </ol>
        </nav>
    </div>

    <!-- Product Detail Section -->
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-5 mb-4 mb-md-0">
                         <?php
                            $images = json_decode($product['img'], true);
                            $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($product['img']) && !empty($product['img']) ? $product['img'] : '');
                            $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $product['id'];
                        ?>
                        <div class="border rounded p-2 mb-2">
                             <img src="<?php echo e($imgSrc); ?>" class="img-fluid w-100 rounded" alt="<?php echo e($product['name']); ?>" style="object-fit: contain; max-height: 400px;">
                        </div>
                        <?php if(is_array($images) && count($images) > 1): ?>
                        <div class="d-flex gap-2 overflow-auto">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="width: 80px; height: 80px;" class="border rounded p-1 cursor-pointer">
                                 <img src="/app/images/img/<?php echo e($img); ?>" class="w-100 h-100" style="object-fit: cover;" onclick="document.querySelector('.img-fluid').src=this.src">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-7">
                        <h3 class="fw-bold mb-3"><?php echo e($product['name']); ?></h3>
                        <div class="d-flex align-items-center mb-3">
                            <span class="h4 text-danger fw-bold me-3"><?php echo e(number_format($product['price'], 0, ',', '.')); ?>đ</span>
                            <?php if(isset($product['quantity']) && $product['quantity'] > 0): ?>
                                <span class="badge bg-success">Còn hàng</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Hết hàng</span>
                            <?php endif; ?>
                        </div>
                        <span class="card-title mb-2 fw-bold text-truncate">
                            <span class="fs-5">Số lượng: <?php echo e($product ['quantity']); ?></span>
                        </span>

                        <p class="text-muted mb-4 mt-3">
                            <?php echo e($product['mota'] ?? 'Chưa có mô tả cho sản phẩm này.'); ?>

                        </p>

                        <div class="d-flex gap-2 mb-4">
                             <a href="/cart/add/<?php echo e($product['id']); ?>" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ
                            </a>
                            <a href="/user/addFavorite/<?php echo e($product['id']); ?>" class="btn btn-outline-danger btn-lg" title="Yêu thích">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>

                        <div class="border-top pt-3">
                            <p><small class="text-muted">Mã sản phẩm: #<?php echo e($product['id']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="col-12 mt-4">
        <h4 class="mb-3 fw-bold border-bottom pb-2">Sản phẩm liên quan</h4>
        <div class="row g-3">
             <?php $__empty_1 = true; $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-6 col-md-3">
                 <div class="card h-100 shadow-sm border-0 product-card">
                    <?php
                        $rImages = json_decode($item['img'], true);
                        $rDisplayImg = is_array($rImages) && !empty($rImages) ? $rImages[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $rImgSrc = !empty($rDisplayImg) ? "/app/images/img/" . $rDisplayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    ?>
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/<?php echo e($item['id']); ?>">
                            <img src="<?php echo e($rImgSrc); ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="<?php echo e($item['name']); ?>" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-dark"><?php echo e($item['name']); ?></a>
                        </span>
                        <span class="card-title mb-2 fw-bold text-truncate">
                            <span>Số lượng: <?php echo e($item ['quantity']); ?></span>
                        </span>
                        <div class="mt-auto pt-2">
                             <div class="fw-bold text-danger"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12 p-3 text-muted">Không có sản phẩm liên quan nào.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Da xem gan day  -->
<?php if(isset($recentProducts) && count($recentProducts) > 0): ?>
<div class="row mt-4">
    <div class="col-12">
        <h4 class="mb-3 fw-bold border-bottom pb-2 mt-3">
            Đã xem gần đây
        </h4>
        <div class="row g-3">
            <?php $__currentLoopData = $recentProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <?php
                        $rImages = json_decode($item['img'], true);
                        $rDisplayImg = is_array($rImages) && !empty($rImages) ? $rImages[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $rImgSrc = !empty($rDisplayImg) ? "/app/images/img/" . $rDisplayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    ?>
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/<?php echo e($item['id']); ?>">
                            <img src="<?php echo e($rImgSrc); ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="<?php echo e($item['name']); ?>" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-dark"><?php echo e($item['name']); ?></a>
                        </h6>
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-dark">Số lượng: <?php echo e($item ['quantity']); ?></a>
                        </span>
                        <div class="mt-auto pt-2">
                            <div class="fw-bold text-danger"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<style>
    .cursor-pointer { cursor: pointer; }
    .cursor-pointer:hover { border-color: #0d6efd !important; }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/products/detail.blade.php ENDPATH**/ ?>