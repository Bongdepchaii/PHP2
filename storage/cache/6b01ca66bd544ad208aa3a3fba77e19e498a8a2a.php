
<?php $__env->startSection('title', 'Liên hệ với chúng tôi'); ?>
<?php $__env->startSection('content'); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
           <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="fw-bold mb-1 text-center">Liên hệ với chúng tôi</h2>
                    <p class="text-muted text-center mb-4">Có thắc mắc? Hãy gửi tin nhắn, chúng tôi sẽ phản hồi sớm nhất!</p>

                    <?php $old = $_SESSION['contact_old'] ?? []; unset($_SESSION['contact_old']); ?>

                    <form action="/contact/add" method="POST" novalidate id="contactForm">
                        <div class="row g-3">
                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name"
                                       placeholder="Nguyễn Văn A"
                                       value="<?php echo e($old['full_name'] ?? ''); ?>" required>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="email@example.com"
                                       value="<?php echo e($old['email'] ?? ''); ?>" required>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone"
                                       placeholder="0912 345 678"
                                       value="<?php echo e($old['phone'] ?? ''); ?>" required>
                            </div>

                            
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Chủ đề <span class="text-danger">*</span></label>
                                <select class="form-select" name="subject" required>
                                    <option value="" disabled <?php echo e(empty($old['subject']) ? 'selected' : ''); ?>>-- Chọn chủ đề --</option>
                                    <?php $__currentLoopData = ['Đặt hàng & Giao hàng','Đổi trả & Hoàn tiền','Sản phẩm','Tài khoản','Khác']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($opt); ?>" <?php echo e(($old['subject'] ?? '') === $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nội dung <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="5"
                                          placeholder="Nhập nội dung tin nhắn của bạn (tối thiểu 10 ký tự)..." required><?php echo e($old['message'] ?? ''); ?></textarea>
                            </div>

                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                    <i class="fas fa-paper-plane me-2"></i>Gửi tin nhắn
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-primary text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-envelope fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Email</h6>
                            <p class="text-muted small mb-0">contact@tbs.vn</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-success text-success rounded-circle mx-auto mb-3">
                                <i class="fas fa-phone fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Hotline</h6>
                            <p class="text-muted small mb-0">0912 345 678</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-warning text-warning rounded-circle mx-auto mb-3">
                                <i class="fas fa-map-marker-alt fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Địa chỉ</h6>
                            <p class="text-muted small mb-0">123 Đường ABC, TP.HCM</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/contact/index.blade.php ENDPATH**/ ?>