<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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
            <div class="col-md-6 col-lg-5">
                <div class="card p-3 shadow-sm border-0" style="border-radius: 10px;">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="https://thanhbui.click/wp-content/uploads/2025/09/tbs-removebg-preview.png" alt="Logo" style="width: 80px; margin-bottom: 10px;">
                            <h5 class="fw-bold text-primary">Tạo Tài Khoản</h5>
                            <p class="text-muted small">Tham gia cùng chúng tôi</p>
                        </div>

                        <!-- Include Alert
                        @if(isset($_SESSION['success']))
                        <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                          {{$_SESSION['success']}}
                          <button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(isset($_SESSION['error']))
                        <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                           {{$_SESSION['error']}}
                          <button type="button" class="btn-close pb-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        
                        @php
                        unset($_SESSION['success']);
                        unset($_SESSION['error']);
                        @endphp -->

                        @include('layouts.includes.notification')
                        
                        <form action="/auth/register" method="POST">
                            <div class="row">
                                 <div class="col-md-12 mb-2">
                                    <label for="username" class="form-label small fw-semibold">Tài khoản</label>
                                    <input type="text" class="form-control form-control-sm bg-light p-2" id="username" name="username" required>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="name" class="form-label small fw-semibold">Họ tên</label>
                                    <input type="text" class="form-control form-control-sm bg-light p-2" id="name" name="name" required>
                                </div>
                            </div>
                           
                            <div class="mb-2">
                                <label for="email" class="form-label small fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-sm bg-light p-2" id="email" name="email" placeholder="name@example.com" required>
                            </div>

                            <div class="mb-2">
                                <label for="password" class="form-label small fw-semibold">Mật khẩu</label>
                                <input type="password" class="form-control form-control-sm bg-light p-2" id="password" name="password" placeholder="********" required>
                            </div>
                             <div class="mb-3">
                                <label for="confirm_password" class="form-label small fw-semibold">Nhập lại Mật khẩu</label>
                                <input type="password" class="form-control form-control-sm bg-light p-2" id="confirm_password" name="confirm_password" required>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-sm fw-bold shadow-sm py-2">Đăng Ký</button>
                            </div>

                            <div class="text-center small">
                                <span class="text-muted">Đã có tài khoản?</span>
                                <a href="/auth/login" class="fw-bold text-decoration-none ms-1">Đăng nhập</a>
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