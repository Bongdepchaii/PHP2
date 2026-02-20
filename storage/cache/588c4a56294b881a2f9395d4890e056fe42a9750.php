<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px 20px;
            text-align: center;
        }
        .otp-input {
            width: 50px !important;
            height: 55px;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            border-radius: 12px !important;
            border: 2px solid #dee2e6;
            transition: all 0.3s;
        }
        .otp-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-gradient:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
            color: white;
        }
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .step-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
        }
        .step-dot.active { background: white; }
        #section-otp, #section-newpass { display: none; }
        .otp-group { gap: 8px; }
        .countdown { font-size: 0.85rem; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card">

                <!-- Header -->
                <div class="card-header-custom">
                    <div class="step-indicator">
                        <div class="step-dot active" id="dot1"></div>
                        <div class="step-dot" id="dot2"></div>
                        <div class="step-dot" id="dot3"></div>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-lock text-white" style="font-size:2.5rem;"></i>
                    </div>
                    <h5 class="text-white fw-bold mb-1" id="step-title">Quên Mật Khẩu</h5>
                    <p class="text-white-50 small mb-0" id="step-desc">Nhập email để nhận mã OTP</p>
                </div>

                <div class="card-body p-4">

                    <?php if(isset($_SESSION['forgot_error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show py-2 small">
                        <?php echo e($_SESSION['forgot_error']); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['forgot_error']); ?>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['forgot_success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show py-2 small">
                        <?php echo e($_SESSION['forgot_success']); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['forgot_success']); ?>
                    <?php endif; ?>

                    
                    <div id="section-email">
                        <form action="/auth/sendOtp" method="POST">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Địa chỉ Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control bg-light border-start-0"
                                           placeholder="example@gmail.com" required
                                           value="<?php echo e($email ?? ''); ?>">
                                </div>
                                <div class="form-text">Chúng tôi sẽ gửi mã OTP 6 số về email của bạn.</div>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-gradient">
                                    <i class="fas fa-paper-plane me-2"></i>Gửi mã OTP
                                </button>
                            </div>
                        </form>
                        <div class="text-center small">
                            <a href="/auth/login" class="text-decoration-none text-muted">
                                <i class="fas fa-arrow-left me-1"></i>Quay lại đăng nhập
                            </a>
                        </div>
                    </div>

                    
                    <?php if(isset($_SESSION['otp_sent']) && $_SESSION['otp_sent']): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showStep('otp');
                        });
                    </script>
                    <?php unset($_SESSION['otp_sent']); ?>
                    <?php endif; ?>

                    <div id="section-otp">
                        <form action="/auth/verifyOtp" method="POST">
                            <div class="mb-3 text-center">
                                <p class="small text-muted mb-3">
                                    Nhập mã <strong>6 chữ số</strong> đã gửi đến
                                    <strong><?php echo e($_SESSION['otp_email'] ?? ''); ?></strong>
                                </p>
                                <div class="d-flex justify-content-center otp-group" id="otp-group">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                    <input type="text" class="otp-input form-control" maxlength="1" inputmode="numeric" pattern="[0-9]">
                                </div>
                                <input type="hidden" name="otp" id="otp-hidden">
                            </div>
                            <div class="text-center mb-3">
                                <span class="countdown text-muted">
                                    Mã hết hạn sau: <strong id="countdown-timer">05:00</strong>
                                </span>
                            </div>
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-gradient" id="btn-verify-otp">
                                    <i class="fas fa-check me-2"></i>Xác nhận OTP
                                </button>
                            </div>
                        </form>
                        <div class="text-center small mt-2">
                            <span class="text-muted">Chưa nhận được mã? </span>
                            <a href="#" onclick="showStep('email')" class="text-decoration-none fw-bold">Thử lại</a>
                        </div>
                    </div>

                    
                    <?php if(isset($_SESSION['otp_verified']) && $_SESSION['otp_verified']): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            showStep('newpass');
                        });
                    </script>
                    <?php unset($_SESSION['otp_verified']); ?>
                    <?php endif; ?>

                    <div id="section-newpass">
                        <form action="/auth/resetPassword" method="POST">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold text-muted">Mật khẩu mới</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="new_password" class="form-control bg-light border-start-0"
                                           placeholder="Nhập mật khẩu mới" required minlength="6">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-semibold text-muted">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="confirm_password" class="form-control bg-light border-start-0"
                                           placeholder="Nhập lại mật khẩu" required minlength="6">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gradient">
                                    <i class="fas fa-save me-2"></i>Cập nhật mật khẩu
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ============ ĐIỀU HƯỚNG BƯỚC ============
    function showStep(step) {
        document.getElementById('section-email').style.display = 'none';
        document.getElementById('section-otp').style.display = 'none';
        document.getElementById('section-newpass').style.display = 'none';

        const dots = [document.getElementById('dot1'), document.getElementById('dot2'), document.getElementById('dot3')];
        dots.forEach(d => d.classList.remove('active'));

        const titles = {
            email:   ['Quên Mật Khẩu', 'Nhập email để nhận mã OTP', 0],
            otp:     ['Xác Nhận OTP', 'Kiểm tra email và nhập mã 6 số', 1],
            newpass: ['Đặt Mật Khẩu Mới', 'Nhập mật khẩu mới của bạn', 2],
        };

        const [title, desc, dotIdx] = titles[step];
        document.getElementById('step-title').textContent = title;
        document.getElementById('step-desc').textContent = desc;
        dots[dotIdx].classList.add('active');
        document.getElementById('section-' + step).style.display = 'block';

        if (step === 'otp') startCountdown(5 * 60);
    }

    // ============ OTP INPUT - tự nhảy ô ============
    const otpInputs = document.querySelectorAll('.otp-input');
    const hiddenOtp = document.getElementById('otp-hidden');

    otpInputs.forEach((input, idx) => {
        input.addEventListener('input', (e) => {
            const val = e.target.value.replace(/\D/g, '');
            e.target.value = val;
            if (val && idx < otpInputs.length - 1) {
                otpInputs[idx + 1].focus();
            }
            updateHiddenOtp();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && idx > 0) {
                otpInputs[idx - 1].focus();
            }
        });

        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            [...text].slice(0, 6).forEach((char, i) => {
                if (otpInputs[i]) otpInputs[i].value = char;
            });
            updateHiddenOtp();
            const next = Math.min(text.length, 5);
            otpInputs[next].focus();
        });
    });

    function updateHiddenOtp() {
        hiddenOtp.value = [...otpInputs].map(i => i.value).join('');
    }

    // ============ ĐẾM NGƯỢC 5 PHÚT ============
    let countdownInterval;
    function startCountdown(seconds) {
        clearInterval(countdownInterval);
        const timerEl = document.getElementById('countdown-timer');
        countdownInterval = setInterval(() => {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            timerEl.textContent = String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
            if (seconds <= 0) {
                clearInterval(countdownInterval);
                timerEl.textContent = 'Đã hết hạn';
                timerEl.classList.add('text-danger');
            }
            seconds--;
        }, 1000);
    }

    // ============ KHỞI TẠO BƯỚC MẶC ĐỊNH ============
    showStep('email');
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/users/forgot.blade.php ENDPATH**/ ?>