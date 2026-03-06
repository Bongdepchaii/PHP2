<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form đặt lịch hẹn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container py-4">
    <h1 class="h4 mb-3">Cuộc hẹn của tôi</h1>
       <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Ngày hẹn</th>
                <th>Giờ hẹn</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($item['id']); ?></td>
                    <td><?php echo e($item['name']); ?></td>
                    <td><?php echo e($item['phone']); ?></td>
                    <td><?php echo e($item['date']); ?></td>
                    <td><?php echo e($item['time']); ?></td>
                    <td>
                      <a href="detail/<?php echo e($item['id']); ?>" type="button" class="btn btn-sm btn-warning">Xem chi tiết</a>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/booking/booking.blade.php ENDPATH**/ ?>