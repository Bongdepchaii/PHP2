
<?php $__env->startSection('title', $title ?? 'Yêu thích'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.favorite-card { transition: transform .2s, box-shadow .2s; }
.favorite-card:hover { transform: translateY(-4px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.12)!important; }
.product-img-wrapper { position: relative; padding-top: 75%; overflow: hidden; }
.product-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4">

    
    <?php echo $__env->make('layouts.includes.user_nav', ['user' => $user ?? [], 'activeTab' => 'favorites'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="col-12 col-md-9">

        <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <h5 class="fw-bold mb-4"><i class="fas fa-heart me-2 text-danger"></i>Sản phẩm yêu thích</h5>

        <?php if(!empty($favorites)): ?>
            <div class="row g-3">
                <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $images     = json_decode($item['img'], true);
                    $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                    $imgSrc     = !empty($displayImg) ? "/app/images/img/{$displayImg}" : "https://picsum.photos/300/225?random={$item['id']}";
                ?>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm favorite-card position-relative">

                        
                        <a href="/user/deleteFavorite/<?php echo e($item['favorite_id']); ?>"
                           class="btn btn-light btn-sm rounded-circle position-absolute top-0 end-0 m-2 shadow-sm z-2 text-danger"
                           onclick="return confirm('Xóa khỏi yêu thích?')" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </a>

                        <a href="/product/detail/<?php echo e($item['id']); ?>">
                            <div class="product-img-wrapper rounded-top">
                                <img src="<?php echo e($imgSrc); ?>" class="product-img" alt="<?php echo e($item['name']); ?>">
                            </div>
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold text-truncate mb-1" title="<?php echo e($item['name']); ?>">
                                <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-dark"><?php echo e($item['name']); ?></a>
                            </h6>
                            <p class="small text-muted flex-grow-1 mb-2"><?php echo e(substr($item['mota'] ?? '', 0, 70)); ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-danger"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</span>
                                <small class="text-muted"><?php echo e(date('d/m', strtotime($item['favorite_at']))); ?></small>
                            </div>
                            <a href="/cart/add/<?php echo e($item['id']); ?>" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3"
                     style="width:90px;height:90px;">
                    <i class="fas fa-heart text-secondary" style="font-size:2.5rem;"></i>
                </div>
                <h5 class="text-muted fw-normal">Danh sách yêu thích trống</h5>
                <p class="text-secondary">Lưu những sản phẩm bạn quan tâm để xem lại sau!</p>
                <a href="/" class="btn btn-primary px-4">Tiếp tục mua sắm</a>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/users/favorite.blade.php ENDPATH**/ ?>