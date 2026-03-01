
<?php $__env->startSection('title', 'Trang chủ'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <!-- Sidebar Category -->
    <div class="col-lg-3 mb-4">
        <?php echo $__env->make('layouts.includes.slidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <!-- Product List -->
    <div class="col-lg-9">

        
        <?php if($keyword): ?>
        <div class="d-flex align-items-center mb-3">
            <h6 class="mb-0 fw-semibold">
                <i class="fas fa-search me-2 text-primary"></i>
                Kết quả cho &ldquo;<span class="text-primary"><?php echo e($keyword); ?></span>&rdquo;
            </h6>
            <span class="badge bg-soft-primary text-primary ms-2"><?php echo e($total); ?> sản phẩm</span>
            <a href="/home/index" class="btn btn-sm btn-outline-secondary ms-auto">
                <i class="fas fa-times me-1"></i>Xóa tìm kiếm
            </a>
        </div>
        <?php endif; ?>

        <div class="row g-3">
            <?php
            $catMap = array_column($categories, 'name', 'id');
            if (!class_exists('QtyHelperHome')) {
                class QtyHelperHome extends Model {
                    public function getTotalQty($product) {
                        $total = $product['quantity'] ?? 0;
                        try {
                            $stmt = $this->connect()->prepare("SELECT SUM(quantity) FROM variant WHERE id_product = ?");
                            $stmt->execute([$product['id']]);
                            $total += (int)$stmt->fetchColumn();
                        } catch (\Exception $e) {}
                        return $total;
                    }
                }
            }
            $qtyHelperHome = new QtyHelperHome();
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <?php
                        $images = json_decode($item['img'], true);
                        $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    ?>
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/<?php echo e($item['id']); ?>">
                            <img src="<?php echo e($imgSrc); ?>" class="position-absolute top-0 start-0 w-100 h-100" alt="<?php echo e($item['name']); ?>" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                             <span class="badge bg-light text-dark border"><?php echo e($catMap[$item['id_category']] ?? 'Khác'); ?></span>
                        </div>
                        <h6 class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-dark"><?php echo e($item['name']); ?></a>
                        </h6>
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/<?php echo e($item['id']); ?>" class="text-decoration-none text-primary">Số lượng: <?php echo e($qtyHelperHome->getTotalQty($item)); ?></a>
                        </span>
                        <!-- <p class="card-text text-muted small mb-2 flex-grow-1"><?php echo e(substr($item['mota'], 0, 80) . "..."); ?></p> -->
                        
                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="fw-bold text-danger fs-5"><?php echo e($item['price_vnd'] ?? number_format($item['price'], 0, ',', '.') . 'đ'); ?></div>
                            </div>
                            <div class="d-grid gap-2">
                                <div class="btn-group">
                                    <a href="/cart/add/<?php echo e($item['id']); ?>" class="btn btn-primary btn-sm rounded-start">
                                        <i class="fas fa-cart-plus me-1"></i> Mua
                                    </a>
                                    <a href="/user/addFavorite/<?php echo e($item['id']); ?>" class="btn btn-outline-danger btn-sm rounded-end" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fs-1 mb-3 d-block text-info"></i>
                    Không tìm thấy sản phẩm nào trong danh mục này.
                </div>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="d-flex flex-column align-items-center mt-4 gap-2">
            <?php if($totalPage > 1): ?>
            <nav>
                <ul class="pagination mb-0">
                    
                    <li class="page-item <?php echo e($page <= 1 ? 'disabled' : ''); ?>">
                        <a class="page-link" href="/home/index?page=<?php echo e($page - 1); ?>&q=<?php echo e(urlencode($keyword)); ?>&id_category=<?php echo e($selectedCategory); ?>&id_trademark=<?php echo e($selectedTrademark); ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    
                    <?php for($p = max(1, $page - 2); $p <= min($totalPage, $page + 2); $p++): ?>
                    <li class="page-item <?php echo e($p === $page ? 'active' : ''); ?>">
                        <a class="page-link" href="/home/index?page=<?php echo e($p); ?>&q=<?php echo e(urlencode($keyword)); ?>&id_category=<?php echo e($selectedCategory); ?>&id_trademark=<?php echo e($selectedTrademark); ?>"><?php echo e($p); ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <li class="page-item <?php echo e($page >= $totalPage ? 'disabled' : ''); ?>">
                        <a class="page-link" href="/home/index?page=<?php echo e($page + 1); ?>&q=<?php echo e(urlencode($keyword)); ?>&id_category=<?php echo e($selectedCategory); ?>&id_trademark=<?php echo e($selectedTrademark); ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
            <p class="text-muted small mb-0">
                Hiển <strong><?php echo e(min(($page - 1) * $perPage + 1, $total)); ?>&ndash;<?php echo e(min($page * $perPage, $total)); ?></strong>
                trong tổng <strong><?php echo e($total); ?></strong> sản phẩm
                <?php if($totalPage > 1): ?>· Trang <?php echo e($page); ?>/<?php echo e($totalPage); ?><?php endif; ?>
            </p>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    // alert("hello world")
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/home/index.blade.php ENDPATH**/ ?>