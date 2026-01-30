<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/LogoTBS.png" />
    @stack('styles')
</head>

<body class="bg-light">

    <!-- Navbar -->
    @include('layouts.includes.header')

    <!-- Main -->
    <main class="container py-4">
        <div class="row g-4">
            <!-- Products -->
            <section class="col-12 col-lg-8">
                @yield('content')
            </section>
            @include('layouts.includes.slidebar_cart')

        </div>
    </main>
    @include('layouts.includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>