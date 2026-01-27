<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body class="bg-light">

    <!-- Navbar -->
    @include('layouts.includes.header')

    <!-- Main -->
    <main class="container py-4">
        <div class="row g-4">
            <!-- Sidebar Categories -->
            @include('layouts.includes.slidebar')
            <!-- Products -->
            <section class="col-12 col-lg-9">
                @yield('content')
            </section>

        </div>
    </main>

    <!-- Footer -->
    <footer class="border-top bg-white">
        <div class="container py-3 d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div class="text-muted small">© 2026 MyShop. All rights reserved.</div>
            <div class="d-flex gap-3">
                <a class="text-decoration-none" href="#">Privacy</a>
                <a class="text-decoration-none" href="#">Terms</a>
                <a class="text-decoration-none" href="#">Support</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>