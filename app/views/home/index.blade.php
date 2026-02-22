@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')

<div class="row">
    <!-- Sidebar Category -->
    <div class="col-lg-3 mb-4">
        @include('layouts.includes.slidebar')
    </div>

    <!-- Product List -->
    <div class="col-lg-9">
        <div class="row g-3">
            @php
            $catMap = array_column($categories, 'name', 'id');
            @endphp
            @forelse ($products as $item)
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card h-100 shadow-sm border-0 product-card">
                    @php
                        $images = json_decode($item['img'], true);
                        $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    @endphp
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/{{ $item['id'] }}">
                            <img src="{{ $imgSrc }}" class="position-absolute top-0 start-0 w-100 h-100" alt="{{ $item['name'] }}" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                             <span class="badge bg-light text-dark border">{{ $catMap[$item['id_category']] ?? 'Khác' }}</span>
                        </div>
                        <h6 class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-dark">{{ $item['name'] }}</a>
                        </h6>
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-primary">Số lượng: {{$item ['quantity']}}</a>
                        </span>
                        <!-- <p class="card-text text-muted small mb-2 flex-grow-1">{{ substr($item['mota'], 0, 80) . "..." }}</p> -->
                        
                        <div class="mt-auto pt-3 border-top">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="fw-bold text-danger fs-5">{{ number_format($item['price'], 0, ',', '.') }}đ</div>
                            </div>
                            <div class="d-grid gap-2">
                                <div class="btn-group">
                                    <a href="/cart/add/{{ $item['id'] }}" class="btn btn-primary btn-sm rounded-start">
                                        <i class="fas fa-cart-plus me-1"></i> Mua
                                    </a>
                                    <a href="/user/addFavorite/{{ $item['id'] }}" class="btn btn-outline-danger btn-sm rounded-end" title="Yêu thích">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5">
                    <i class="fas fa-search fs-1 mb-3 d-block text-info"></i>
                    Không tìm thấy sản phẩm nào trong danh mục này.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    // alert("hello world")
</script>
@endpush