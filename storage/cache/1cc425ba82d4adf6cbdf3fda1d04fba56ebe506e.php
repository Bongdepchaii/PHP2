
<?php $__env->startSection('title', 'Quản lý Liên hệ'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách liên hệ</h5>
                <!-- Contact messages are submitted by users, so no "Add" button here usually -->
            </div>
            <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên người gửi</th>
                                <th scope="col">Email / SĐT</th>
                                <th scope="col">Chủ đề</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ngày gửi</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center text-muted fw-semibold"><?php echo e($item['id']); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($item['name']); ?></td>
                                <td>
                                    <div><i class="feather-mail me-1 text-muted"></i> <?php echo e($item['email']); ?></div>
                                    <div class="small text-muted"><i class="feather-phone me-1"></i> <?php echo e($item['phone']); ?></div>
                                </td>
                                <td><?php echo e($item['subject']); ?></td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;" title="<?php echo e($item['message']); ?>">
                                        <?php echo e($item['message']); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(isset($item['created_at']) ? date('d/m/Y H:i', strtotime($item['created_at'])) : 'N/A'); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <!-- View details modal trigger could go here -->
                                        <a href="/contact/delete/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xoá liên hệ này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($contacts)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="feather-message-circle fs-1 display-6 d-block mb-2"></i>
                                    Chưa có liên hệ nào
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
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/contact/admin.blade.php ENDPATH**/ ?>