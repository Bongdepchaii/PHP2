
<?php $__env->startSection('title', 'Quản lý danh mục'); ?>
<?php $__env->startSection('content'); ?>
    <a href="/category/add" class="btn btn-sm btn-light border text-succes mb-3">Thêm danh mục</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ngày tạo</th>
            <th>Act</th>
        </tr>
        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['id']); ?></td>
                <td><?php echo e($item['name']); ?></td>
                <td><?php echo e($item['created_at']); ?></td>
                <td>
                    <a href="/category/edit/<?php echo e($item['id']); ?>" class="btn btn-sm btn-light border text-primary">Sửa</a>
                    <a href="/category/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-light border text-danger">Xoá</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    // alert("hello world")
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/categorys/index.blade.php ENDPATH**/ ?>