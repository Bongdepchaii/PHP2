<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --bg-color: #f0f2f5;
        }
        
        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .profile-container {
            max-width: 850px; /* Reduced width */
            width: 100%;
            background: white;
            border-radius: 15px; /* Slightly smaller radius */
            box-shadow: 0 10px 25px rgba(0,0,0,0.08); /* Softer shadow */
            overflow: hidden;
            position: relative;
        }

        .profile-sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 30px 15px; /* Reduced padding */
            position: relative;
            overflow: hidden;
        }

        /* Ambient Circles - reduced opacity/size */
        .profile-sidebar::before {
            content: '';
            position: absolute;
            top: -40px;
            left: -40px;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .profile-sidebar::after {
            content: '';
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .avatar-container {
            position: relative;
            margin-bottom: 15px;
            display: inline-block;
        }

        .user-avatar {
            width: 110px; /* Smaller avatar */
            height: 110px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .user-role {
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            display: inline-block;
            margin-top: 8px;
            backdrop-filter: blur(5px);
        }

        .profile-content {
            padding: 30px; /* Reduced padding */
        }

        .form-label {
            font-weight: 500;
            color: #555;
            font-size: 0.85rem; /* Smaller font */
            margin-bottom: 0.3rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 8px 12px; /* Compact input */
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            border-color: var(--accent-color);
            background-color: #fff;
        }

        .btn-update {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 10px 25px; /* Compact button */
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .btn-back {
            color: #666;
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            transition: color 0.2s;
            margin-bottom: 15px; /* Reduced margin */
        }

        .btn-back:hover {
            color: var(--primary-color);
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px; /* Reduced margin */
            color: rgba(255,255,255,0.9);
            font-size: 0.85rem;
        }

        .info-item i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
        }
        
        /* Animation */
        @keyframes  fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .profile-container {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>

    <div class="profile-container">
        <div class="row g-0">
            <!-- Left Sidebar -->
            <div class="col-md-4 profile-sidebar d-flex flex-column justify-content-center align-items-center">
                <div class="avatar-container">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user['name'])); ?>&background=random&color=fff&size=150" 
                         alt="Avatar" class="user-avatar">
                </div>
                <h4 class="fw-bold mb-1" style="font-size: 1.25rem;"><?php echo e($user['name']); ?></h4>
                <div class="user-role">
                    <?php echo e($user['role'] == 'admin' ? 'Quản Trị Viên' : 'Thành Viên'); ?>

                </div>
                
                <div class="mt-4 w-100 px-3 text-start">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i> <?php echo e($user['email']); ?>

                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i> Tham gia: <?php echo e(date('d/m/Y', strtotime($user['created_at']))); ?>

                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i> <?php echo e($user['address'] ? $user['address'] : 'Chưa cập nhật'); ?>

                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-md-8 profile-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="/" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i> Trở về
                    </a>
                    <a href="/auth/logout" class="btn btn-outline-danger btn-sm rounded-pill px-3" style="font-size: 0.8rem;">
                        <i class="fas fa-sign-out-alt me-1"></i> Đăng xuất
                    </a>
                </div>

                <h5 class="fw-bold mb-3" style="color: var(--primary-color);">Cập nhật thông tin</h5>

                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> <?php echo e($_SESSION['success']); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> <?php echo e($_SESSION['error']); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="/auth/profile" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user['name']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e($user['email']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="age" class="form-label">Tuổi</label>
                            <input type="number" class="form-control" id="age" name="age" value="<?php echo e($user['age']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sex" class="form-label">Giới tính</label>
                            <select class="form-select" id="sex" name="sex">
                                <option value="Male" <?php echo e($user['sex'] == 'Male' ? 'selected' : ''); ?>>Nam</option>
                                <option value="Female" <?php echo e($user['sex'] == 'Female' ? 'selected' : ''); ?>>Nữ</option>
                                <option value="Other" <?php echo e($user['sex'] == 'Other' ? 'selected' : ''); ?>>Khác</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo e($user['address']); ?>" placeholder="Nhập địa chỉ của bạn">
                        </div>
                        
                        <div class="col-12 mt-4">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="fw-bold mb-3 small text-uppercase text-muted">Đổi mật khẩu (Tuỳ chọn)</label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mật khẩu mới">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-update">
                                <i class="fas fa-save me-2"></i> Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\PHP2\app\views/users/profile.blade.php ENDPATH**/ ?>