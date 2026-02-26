
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">

            
            <div class="card-header d-flex flex-wrap align-items-center gap-2">
                <h5 class="card-title me-auto mb-0">
                    Danh sách liên hệ
                    <span class="badge bg-soft-secondary text-secondary ms-2"><?php echo e($total); ?></span>
                </h5>
                
                <form method="GET" action="/contact/admin" class="d-flex align-items-center">
                    <div class="input-group input-group-sm" style="width:260px;">
                        <input type="text" class="form-control" name="q"
                               placeholder="Tìm tên, email, chủ đề..."
                               value="<?php echo e($keyword); ?>">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="feather-search"></i>
                        </button>
                        <?php if($keyword): ?>
                        <a href="/contact/admin" class="btn btn-outline-danger" title="Xóa tìm kiếm">
                            <i class="feather-x"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width:50px;">ID</th>
                                <th>Người gửi</th>
                                <th>Email / SĐT</th>
                                <th>Chủ đề</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-center text-muted fw-semibold">#<?php echo e($item['id']); ?></td>
                                <td class="fw-semibold"><?php echo e($item['full_name']); ?></td>
                                <td>
                                    <div><i class="feather-mail me-1 text-muted"></i><?php echo e($item['email']); ?></div>
                                    <div class="small text-muted"><i class="feather-phone me-1"></i><?php echo e($item['phone']); ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary"><?php echo e($item['subject']); ?></span>
                                </td>
                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate w-100" title="<?php echo e($item['message']); ?>">
                                        <?php echo e($item['message']); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y H:i', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/contact/delete/<?php echo e($item['id']); ?>?q=<?php echo e(urlencode($keyword)); ?>&from_page=<?php echo e($page); ?>"
                                       class="avatar-text avatar-md text-danger"
                                       title="Xóa liên hệ"
                                       onclick="return confirm('Xóa liên hệ #<?php echo e($item['id']); ?> của <?php echo e($item['full_name']); ?>?');">
                                        <i class="feather-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="feather-message-circle fs-1 display-6 d-block mb-2"></i>
                                    <?php if($keyword): ?>
                                        Không tìm thấy liên hệ nào cho &ldquo;<strong><?php echo e($keyword); ?></strong>&rdquo;
                                    <?php else: ?>
                                        Chưa có liên hệ nào
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <?php if($totalPage > 1 || $total > 0): ?>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-2">
                <small class="text-muted">
                    Hiển <strong><?php echo e(min(($page-1)*$perPage+1, $total)); ?>&ndash;<?php echo e(min($page*$perPage, $total)); ?></strong>
                    trong tổng <strong><?php echo e($total); ?></strong> liên hệ
                    <?php if($keyword): ?><span class="ms-1">cho &ldquo;<strong><?php echo e($keyword); ?></strong>&rdquo;</span><?php endif; ?>
                </small>
                <?php if($totalPage > 1): ?>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item <?php echo e($page <= 1 ? 'disabled' : ''); ?>">
                            <a class="page-link" href="/contact/admin?page=<?php echo e($page-1); ?>&q=<?php echo e(urlencode($keyword)); ?>">
                                <i class="feather-chevron-left"></i>
                            </a>
                        </li>
                        <?php for($p = max(1, $page-2); $p <= min($totalPage, $page+2); $p++): ?>
                        <li class="page-item <?php echo e($p === $page ? 'active' : ''); ?>">
                            <a class="page-link" href="/contact/admin?page=<?php echo e($p); ?>&q=<?php echo e(urlencode($keyword)); ?>"><?php echo e($p); ?></a>
                        </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo e($page >= $totalPage ? 'disabled' : ''); ?>">
                            <a class="page-link" href="/contact/admin?page=<?php echo e($page+1); ?>&q=<?php echo e(urlencode($keyword)); ?>">
                                <i class="feather-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/contact/admin.blade.php ENDPATH**/ ?>