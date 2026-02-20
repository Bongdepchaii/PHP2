<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/LogoTBS.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .favorite-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .favorite-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .product-img-wrapper {
             position: relative;
             padding-top: 75%; /* 4:3 Aspect Ratio */
             overflow: hidden;
        }
        .product-img {
            position: absolute;
            top: 0;
            start: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Header -->
    @include('layouts.includes.header')

    <!-- Main Content -->
    <main class="container py-5 flex-grow-1">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4 text-center text-primary-emphasis">Danh sách yêu thích của bạn</h2>
                <hr class="mb-5 mx-auto w-25 text-primary">
            </div>
        </div>

        <div class="row g-4">
            @if (!empty($favorites))
                @foreach ($favorites as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                        <div class="card h-100 shadow-sm border-0 favorite-card position-relative">
                            @php
                                $images = json_decode($item['img'], true);
                                $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                                $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                            @endphp
                            
                            <!-- Remove Button -->
                            <a href="/user/deleteFavorite/{{ $item['favorite_id'] }}" class="btn btn-light btn-sm rounded-circle position-absolute top-0 end-0 m-2 shadow-sm z-2 text-danger" onclick="return confirm('Bạn có chắc muốn xóa?')" title="Xóa khỏi yêu thích">
                                <i class="bi bi-trash-fill"></i>
                            </a>

                            <div class="product-img-wrapper rounded-top">
                                <img src="{{ $imgSrc }}" class="product-img" alt="{{ $item['name'] }}">
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate" title="{{ $item['name'] }}">{{ $item['name'] }}</h5>
                                <p class="card-text text-muted small mb-3 flex-grow-1">{{ substr($item['mota'], 0, 80) . "..." }}</p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="fs-5 fw-bold text-danger">{{ number_format($item['price'], 0, ',', '.') }}₫</span>
                                        <small class="text-secondary" style="font-size: 0.75rem;">{{ date('d/m', strtotime($item['favorite_at'])) }}</small>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <a href="/cart/add/{{ $item['id'] }}" class="btn btn-outline-primary fw-semibold">
                                            <i class="bi bi-cart-plus me-1"></i> Thêm vào giỏ
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="mb-4">
                        <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 100px; height: 100px;">
                            <i class="bi bi-heart text-secondary" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h4 class="text-muted fw-normal">Danh sách yêu thích trống</h4>
                    <p class="text-secondary mb-4">Lưu lại những sản phẩm bạn quan tâm để xem lại sau nhé!</p>
                    <a href="/" class="btn btn-primary px-4 py-2">Tiếp tục mua sắm</a>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.includes.footer')
        @include('layouts.includes.notification')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>