<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/LogoTBS.png" />
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php echo $__env->make('layouts.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Main -->
    <main class="container py-4">
        <div class="row g-4">
            <!-- Products -->
            <section class="col-12 col-lg-8">
                <?php echo $__env->yieldContent('content'); ?>
            </section>
            <?php echo $__env->make('layouts.includes.slidebar_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </main>
    <?php echo $__env->make('layouts.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/index_cart.blade.php ENDPATH**/ ?>