
<?php $__env->startSection('title', 'Quản lý sản phẩm'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách sản phẩm</h5>
                <a href="/product/add" class="btn btn-primary btn-sm">
                    <i class="feather-plus me-1"></i> Thêm sản phẩm
                </a>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col" style="min-width: 200px;">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col" style="max-width: 300px;">Mô tả</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($item['id']); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-image avatar-md me-3">
                                            <img src="https://picsum.photos/50/50?random=<?php echo e($item['id']); ?>" alt="" class="img-fluid" style="border-radius: 5px;">
                                        </div>
                                        <span class="fw-bold text-dark"><?php echo e($item['name']); ?></span>
                                    </div>
                                </td>
                                <td class="fw-semibold text-danger"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</td>
                                <td class="text-muted text-truncate" style="max-width: 300px;">
                                    <?php echo e(substr($item['mota'], 0, 80) . (strlen($item['mota']) > 80 ? '...' : '')); ?>

                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="/product/edit/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/product/delete/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn có muốn xoá sản phẩm này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($products)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="feather-package fs-1 display-6 d-block mb-2"></i>
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/products/index.blade.php ENDPATH**/ ?>