<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card p-3 shadow-sm border-0" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://thanhbui.click/wp-content/uploads/2025/09/tbs-removebg-preview.png" alt="Logo" style="width: 80px; margin-bottom: 10px;">
                            <h5 class="fw-bold text-primary">Chào mừng</h5>
                            <p class="text-muted small">Đăng nhập để tiếp tục</p>
                        </div>
                        <form action="/auth/login" method="POST">
                            <div class="mb-2">
                                <label for="email" class="form-label small fw-semibold">Email</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control bg-light border-start-0 ps-0 p-2" id="email" name="email" placeholder="name@example.com" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label small fw-semibold">Mật khẩu</label>
                                    <a href="#" class="small text-decoration-none" style="font-size: 0.8rem;">Quên mật khẩu?</a>
                                </div>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" class="form-control bg-light border-start-0 ps-0 p-2" id="password" name="password" placeholder="********" required>
                                </div>
                            </div>
                            <div class="d-grid mb-2">
                                <button type="submit" class="btn btn-primary btn-sm fw-bold shadow-sm py-2">Đăng Nhập</button>
                            </div>
                            
                            <div class="text-center text-muted mb-3 small" style="font-size: 0.8rem;">HOẶC</div>
                            
                            <div class="d-grid gap-2 mb-3">
                                <a href="#" class="btn btn-outline-danger btn-sm fw-semibold py-2">
                                    <i class="fab fa-google me-2"></i> Đăng nhập với Google
                                </a>
                            </div>

                            <div class="text-center small">
                                <span class="text-muted">Chưa có tài khoản?</span>
                                <a href="/auth/register" class="fw-bold text-decoration-none ms-1">Đăng ký ngay</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>