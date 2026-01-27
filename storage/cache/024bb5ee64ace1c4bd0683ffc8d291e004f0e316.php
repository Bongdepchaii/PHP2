<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php echo $__env->make('layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main -->
    <main class="container py-4">
            <?php echo $__env->make('layouts.includes.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row g-4">
            <!-- Sidebar Categories -->
            <?php echo $__env->make('layouts.includes.slidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Products -->
            <section class="col-12 col-lg-9">
                <?php echo $__env->yieldContent('content'); ?>
            </section>

        </div>
    </main>

    <!-- Footer -->
    <!-- <footer class="border-top bg-white">
        <div class="container py-3 d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="text-muted small">© 2026 MyShop. All rights reserved.</div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none" href="#">Privacy</a>
                <a class="text-decoration-none" href="#">Terms</a>
                <a class="text-decoration-none" href="#">Support</a>
            </div>
        </div>
    </footer> -->
    <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\PHP2-NEW\PHP2\app\views/layouts/index.blade.php ENDPATH**/ ?>