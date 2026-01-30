
<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Chào Mừng Trở Lại</h3>
                    <p class="text-muted">Đăng nhập để tiếp tục mua sắm</p>
                </div>

                <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <form action="/auth/login" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="feather-mail text-muted"></i></span>
                            <input type="email" class="form-control bg-light border-start-0 ps-0" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label fw-semibold">Mật khẩu</label>
                            <a href="#" class="small text-decoration-none">Quên mật khẩu?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="feather-lock text-muted"></i></span>
                            <input type="password" class="form-control bg-light border-start-0 ps-0" id="password" name="password" placeholder="******" required>
                        </div>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm">Đăng Nhập</button>
                    </div>
                    
                    <div class="text-center text-muted mb-3">HOẶC</div>
                    
                    <div class="d-grid gap-2 mb-4">
                        <a href="#" class="btn btn-outline-danger btn-lg rounded-pill fw-semibold">
                            <i class="fab fa-google me-2"></i> Đăng nhập với Google
                        </a>
                    </div>

                    <div class="text-center">
                        <span class="text-muted">Chưa có tài khoản?</span>
                        <a href="/auth/register" class="fw-bold text-decoration-none ms-1">Đăng ký ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2\app\views/auth/login.blade.php ENDPATH**/ ?>