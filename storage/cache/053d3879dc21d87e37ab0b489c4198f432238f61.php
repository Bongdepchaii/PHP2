
<?php $__env->startSection('title', 'danh mục'); ?>
<?php $__env->startSection('content'); ?>
    <a href="/category/add" class="btn btn-sm btn-light border text-succes">Them danh muc</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> image </th>
            <th>action</th>
        </tr>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item['id']); ?></td>
                <td><?php echo e($item['name']); ?></td>
                <td><img src="<?php echo e($item['img']); ?>" alt="<?php echo e($item['name']); ?>"></td>
                <td>
                    <a href="/danhmuc/delete/<?php echo e($item['id']); ?>" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2\app\views/home/index.blade.php ENDPATH**/ ?>