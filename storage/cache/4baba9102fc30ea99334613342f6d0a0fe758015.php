
<?php $__env->startSection('title', 'Quản lý người dùng'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header border-bottom border-dashed d-flex flex-wrap align-items-center gap-2">
                <div class="me-auto">
                    <h5 class="card-title mb-1">Danh sách người dùng</h5>
                    <span class="fs-12 text-muted">Quản lý tài khoản và phân quyền truy cập</span>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-user-plus me-1"></i> Tạo người dùng
                </a>
            </div>
              <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#modalEdit"
                                                   data-id="<?php echo e($item['id']); ?>"
                                                   data-username="<?php echo e($item['username']); ?>"
                                                   data-name="<?php echo e($item['name']); ?>"
                                                   data-email="<?php echo e($item['email']); ?>"
                                                   data-age="<?php echo e($item['age']); ?>"
                                                   data-sex="<?php echo e($item['sex']); ?>"
                                                   data-address="<?php echo e($item['address']); ?>"
                                                   data-role="<?php echo e($item['role']); ?>">
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
                                        <a href="javascript:void(0);" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalAdd">Tạo người dùng mới</a>
                                    </div>
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

<style>
    .hover-shadow-sm:hover {
        background-color: #f8f9fa;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="/user/add" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Thêm người dùng mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tài khoản</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tuổi</label>
                            <input type="number" class="form-control" name="age">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="sex">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vai trò</label>
                            <select class="form-select" name="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control" name="address" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formEdit" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Cập nhật người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tài khoản</label>
                            <input type="text" class="form-control" id="usernameEdit" name="username" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mật khẩu (Để trống nếu không đổi)</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="nameEdit" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailEdit" name="email" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tuổi</label>
                            <input type="number" class="form-control" id="ageEdit" name="age">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" id="sexEdit" name="sex">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vai trò</label>
                            <select class="form-select" id="roleEdit" name="role">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="addressEdit" name="address" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const modalEdit = document.getElementById('modalEdit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        
        // Update form action
        const formEdit = modalEdit.querySelector('#formEdit');
        formEdit.action = `/user/update/${id}`;
        
        // Fill fields
        modalEdit.querySelector('#usernameEdit').value = button.getAttribute('data-username');
        modalEdit.querySelector('#nameEdit').value = button.getAttribute('data-name');
        modalEdit.querySelector('#emailEdit').value = button.getAttribute('data-email');
        modalEdit.querySelector('#ageEdit').value = button.getAttribute('data-age');
        modalEdit.querySelector('#sexEdit').value = button.getAttribute('data-sex');
        modalEdit.querySelector('#roleEdit').value = button.getAttribute('data-role').toLowerCase();
        modalEdit.querySelector('#addressEdit').value = button.getAttribute('data-address');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/users/index.blade.php ENDPATH**/ ?>