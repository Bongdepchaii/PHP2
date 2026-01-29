
<?php $__env->startSection('title', 'Quản lý người dùng'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">Danh sách người dùng</h5>
                    <span class="fs-12 text-muted">Quản lý tài khoản và phân quyền truy cập</span>
                </div>
                <a href="/users/add" class="btn btn-primary btn-sm">
                    <i class="feather-user-plus me-1"></i> Tạo người dùng
                </a>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col" style="min-width: 250px;">Thông tin cá nhân</th>
                                <th scope="col">Liên hệ</th>
                                <th scope="col">Tuổi & Giới tính</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col">Ngày tham gia</th>
                                <th scope="col" class="text-end" style="min-width: 100px;">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="transition-all hover-shadow-sm">
                                <td class="text-center text-muted fw-semibold">#<?php echo e($item['id']); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-image avatar-md me-3">
                                            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($item['name'])); ?>&background=random&color=fff" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div>
                                            <a href="#" class="fw-bold text-dark mb-0 text-decoration-none"><?php echo e($item['name']); ?></a>
                                            <div class="fs-12 text-muted"><?php echo e($item['address'] ?? 'Chưa cập nhật địa chỉ'); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="feather-mail text-muted me-2 fs-12"></i>
                                        <span class="text-body"><?php echo e($item['email']); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-dark border"><?php echo e($item['age']); ?> tuổi</span>
                                        <?php if(strtolower($item['sex'] ?? '') == 'nam' || strtolower($item['sex'] ?? '') == 'male'): ?>
                                            <span class="badge bg-soft-primary text-primary"><i class="feather-arrow-up-right me-1"></i> Nam</span>
                                        <?php elseif(strtolower($item['sex'] ?? '') == 'nữ' || strtolower($item['sex'] ?? '') == 'female'): ?>
                                            <span class="badge bg-soft-danger text-danger"><i class="feather-arrow-down-left me-1"></i> Nữ</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted"><?php echo e($item['sex']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if(strtolower($item['role'] ?? '') == 'admin'): ?>
                                        <span class="badge bg-soft-success text-success border border-success-subtle">Administrator</span>
                                    <?php else: ?>
                                        <span class="badge bg-soft-secondary text-secondary border border-secondary-subtle">User</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fs-13 text-muted" data-bs-toggle="tooltip" title="<?php echo e($item['created_at']); ?>">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,10" data-bs-auto-close="outside">
                                            <i class="feather-more-horizontal"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="/users/edit/<?php echo e($item['id']); ?>">
                                                    <i class="feather-edit-3 me-3"></i>Chỉnh sửa
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">
                                                    <i class="feather-eye me-3"></i>Xem chi tiết
                                                </a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="/users/delete/<?php echo e($item['id']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                                    <i class="feather-trash-2 me-3"></i>Xóa tài khoản
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($user)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <div class="text-center">
                                        <i class="feather-users fs-1 display-6 d-block mb-3 opacity-50"></i>
                                        <h6 class="text-muted">Chưa có người dùng nào</h6>
                                        <a href="/users/add" class="btn btn-sm btn-primary mt-2">Tạo người dùng mới</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer border-top-0">
                <!-- Pagination could go here -->
            </div>
        </div>
    </div>
</div>

<style>
    .hover-shadow-sm:hover {
        background-color: #f8f9fa;
    }
</style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/users/index.blade.php ENDPATH**/ ?>