
<?php $__env->startSection('title', 'Quản lý thương hiệu'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách thương hiệu</h5>
                <a href="/trademark/add" class="btn btn-primary btn-sm">
                    <i class="feather-plus me-1"></i> Thêm thương hiệu
                </a>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên thương hiệu</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $trademark; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center text-muted fw-semibold"><?php echo e($item['id']); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($item['name']); ?></td>
                                <td>
                                    <div class="avatar-image avatar-lg">
                                        
                                        <img src="https://picsum.photos/100/50?random=<?php echo e($item['id']); ?>" alt="<?php echo e($item['name']); ?>" class="img-fluid rounded border p-1 bg-white" style="object-fit: contain;">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="#" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="#" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xoá thương hiệu này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($trademark)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="feather-award fs-1 display-6 d-block mb-2"></i>
                                    Chưa có thương hiệu nào
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
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/trademarks/index.blade.php ENDPATH**/ ?>