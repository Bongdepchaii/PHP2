<!-- Thương hiệu -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-award me-2"></i>Thương hiệu</h5>
    </div>
    <div class="card-body">
         <div class="list-group list-group-flush">
            <a href="/" class="list-group-item border-0 rounded list-group-item-action active">Tất cả</a>
            <?php if(isset($trademarks)): ?>
                <?php $__currentLoopData = $trademarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/home/index?id_trademark=<?php echo e($brand['id']); ?>" class="list-group-item list-group-item-action <?php echo e((isset($selectedTrademark) && $selectedTrademark == $brand['id']) ? 'active bg-primary' : ''); ?>"><?php echo e($brand['name']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
         </div>
    </div>
</div>

<!-- Danh mục -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-list-ul me-2"></i>Danh mục</h5>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action border-0 rounded mb-1 <?php echo e(!isset($selectedCategory) ? 'active bg-primary' : ''); ?>">
                <i class="fas fa-th-large me-2"></i>Tất cả sản phẩm
            </a>
            <?php if(isset($categories) && is_array($categories)): ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/home/index?id_category=<?php echo e($cat['id']); ?>" 
                       class="list-group-item list-group-item-action border-0 rounded mb-1 <?php echo e((isset($selectedCategory) && $selectedCategory == $cat['id']) ? 'active bg-primary' : ''); ?>">
                        <i class="fas fa-angle-right me-2 small"></i><?php echo e($cat['name']); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Lọc giá -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-filter me-2"></i>Lọc giá</h5>
    </div>
    <div class="card-body">
         <div class="d-flex gap-2 mb-3">
              <input type="number" class="form-control form-control-sm" placeholder="Từ">
              <input type="number" class="form-control form-control-sm" placeholder="Đến">
         </div>
         <button class="btn btn-primary w-100 btn-sm">Áp dụng</button>
    </div>
</div><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/includes/slidebar.blade.php ENDPATH**/ ?>