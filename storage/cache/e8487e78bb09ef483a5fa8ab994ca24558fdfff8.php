
<?php $__env->startSection('title', 'Quản lý voucher'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách voucher</h5>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-plus me-1"></i> Thêm voucher
                </a>
            </div>
            <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">Mã Voucher</th>
                                <th scope="col">Tên voucher</th>
                                <th scope="col">Giá trị (%)</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Ngày hết hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $voucher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center fw-bold"><?php echo e($item['id']); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($item['name']); ?></td>
                                <td><span class="badge bg-soft-success text-success"><?php echo e($item['value']); ?>%</span></td>
                                <td><?php echo e($item['quanity']); ?></td>
                                <td><?php echo e(date('d/m/Y', strtotime($item['end_date']))); ?></td>
                                <td>
                                    <?php if($item['status'] == 'active'): ?>
                                        <span class="badge bg-success">Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Vô hiệu</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" 
                                           class="avatar-text avatar-md" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#modalEdit"
                                           data-id="<?php echo e($item['id']); ?>"
                                           data-name="<?php echo e($item['name']); ?>"
                                           data-value="<?php echo e($item['value']); ?>"
                                           data-quanity="<?php echo e($item['quanity']); ?>"
                                           data-end_date="<?php echo e(date('Y-m-d', strtotime($item['end_date']))); ?>"
                                           data-status="<?php echo e($item['status']); ?>"
                                           title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/voucher/delete/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa voucher này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($voucher)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="feather-inbox fs-1 display-6 d-block mb-2"></i>
                                    Chưa có voucher nào
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

<?php $__env->startPush('modals'); ?>
<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/voucher/add" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Thêm voucher mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mã Voucher (Tự động nếu để trống)</label>
                        <input type="text" class="form-control" name="id_voucher" placeholder="VD: SALE50">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên voucher</label>
                        <input type="text" class="form-control" name="name" required placeholder="VD: Giảm giá mùa hè">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá trị (%)</label>
                            <input type="number" class="form-control" name="value" required min="0" max="100">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" class="form-control" name="quanity" required min="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Vô hiệu</option>
                            </select>
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
    <div class="modal-dialog">
        <form id="formEdit" action="" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Cập nhật voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <div class="mb-3">
                        <label class="form-label">Mã Voucher</label>
                        <input type="text" class="form-control" id="idVoucherEdit" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên voucher</label>
                        <input type="text" class="form-control" id="nameEdit" name="name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá trị (%)</label>
                            <input type="number" class="form-control" id="valueEdit" name="value" required min="0" max="100">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quanityEdit" name="quanity" required min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="date" class="form-control" id="endDateEdit" name="end_date" required>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" id="statusEdit" name="status">
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Vô hiệu</option>
                            </select>
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

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    const modalEdit = document.getElementById('modalEdit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        const button = event.relatedTarget;
        
        // Extract info from data-* attributes
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const value = button.getAttribute('data-value');
        const quanity = button.getAttribute('data-quanity');
        const endDate = button.getAttribute('data-end_date');
        const status = button.getAttribute('data-status');
        
        // Update the modal's content.
        const formEdit = modalEdit.querySelector('#formEdit');
        const inputId = modalEdit.querySelector('#idVoucherEdit');
        const inputName = modalEdit.querySelector('#nameEdit');
        const inputValue = modalEdit.querySelector('#valueEdit');
        const inputQuanity = modalEdit.querySelector('#quanityEdit');
        const inputEndDate = modalEdit.querySelector('#endDateEdit');
        const inputStatus = modalEdit.querySelector('#statusEdit');

        inputId.value = id;
        inputName.value = name;
        inputValue.value = value;
        inputQuanity.value = quanity;
        inputEndDate.value = endDate;
        inputStatus.value = status;
        
        formEdit.action = `/voucher/update/${id}`;
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/vouchers/index.blade.php ENDPATH**/ ?>