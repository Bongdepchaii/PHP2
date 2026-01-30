
<?php $__env->startSection('title', 'Quản lý danh mục'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách danh mục</h5>
                <!-- Changed to trigger modal -->
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-plus me-1"></i> Thêm danh mục
                </a>
            </div>
                        <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($item['id']); ?></td>
                                <td class="fw-bold text-dark"><?php echo e($item['name']); ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <!-- Changed to trigger modal and pass data -->
                                        <a href="javascript:void(0);" 
                                           class="avatar-text avatar-md" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#modalEdit"
                                           data-id="<?php echo e($item['id']); ?>"
                                           data-name="<?php echo e($item['name']); ?>"
                                           title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/category/delete/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($category)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="feather-inbox fs-1 display-6 d-block mb-2"></i>
                                    Chưa có danh mục nào
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
        <form action="/category/add" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Thêm danh mục mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameAdd" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="nameAdd" name="name" required placeholder="Nhập tên danh mục">
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
                    <h5 class="modal-title" id="modalEditLabel">Cập nhật danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameEdit" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="nameEdit" name="name" required>
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
        
        // Update the modal's content.
        const modalTitle = modalEdit.querySelector('.modal-title');
        const inputName = modalEdit.querySelector('#nameEdit');
        const formEdit = modalEdit.querySelector('#formEdit');

        inputName.value = name;
        formEdit.action = `/category/update/${id}`;
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2\app\views/categorys/index.blade.php ENDPATH**/ ?>