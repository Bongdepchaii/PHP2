@extends('layouts.index')
@section('title', 'Trang chủ')
@section('content')

<div class="row g-3">
    <!-- Product Card -->
    @php
    $catMap = array_column($categories, 'name', 'id');
    @endphp
        @foreach ($products as $item)
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 shadow-sm border-0">
            @php
                $images = json_decode($item['img'], true);
                $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $item['id'];
            @endphp
            <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                <img src="{{ $imgSrc }}" class="position-absolute top-0 start-0 w-100 h-100" alt="{{ $item['name'] }}" style="object-fit: cover;">
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title mb-1">{{ $item['name'] }}</h5>
                    <span class="badge text-bg-primary">{{ $catMap[$item['id_category']] }}</span>
                </div>
                <p class="card-text text-muted small mb-2">{{ substr($item['mota'], 0, 80) . "..." }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-semibold">{{ $item['price'] }}</div>
                    <a href="/cart/add/{{ $item['id'] }}" class="btn btn-sm btn-outline-primary">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
@push('scripts')
<script>
    // alert("hello world")
</script>
@endpush