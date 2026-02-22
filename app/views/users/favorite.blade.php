@extends('layouts.index')
@section('title', $title ?? 'Yêu thích')

@push('styles')
<style>
.favorite-card { transition: transform .2s, box-shadow .2s; }
.favorite-card:hover { transform: translateY(-4px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.12)!important; }
.product-img-wrapper { position: relative; padding-top: 75%; overflow: hidden; }
.product-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
</style>
@endpush

@section('content')
<div class="row g-4">

    {{-- Sidebar nav chung --}}
    @include('layouts.includes.user_nav', ['user' => $user ?? [], 'activeTab' => 'favorites'])

    {{-- Nội dung danh sách yêu thích --}}
    <div class="col-12 col-md-9">

        @include('layouts.includes.notification')

        <h5 class="fw-bold mb-4"><i class="fas fa-heart me-2 text-danger"></i>Sản phẩm yêu thích</h5>

        @if(!empty($favorites))
            <div class="row g-3">
                @foreach($favorites as $item)
                @php
                    $images     = json_decode($item['img'], true);
                    $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                    $imgSrc     = !empty($displayImg) ? "/app/images/img/{$displayImg}" : "https://picsum.photos/300/225?random={$item['id']}";
                @endphp
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm favorite-card position-relative">

                        {{-- Xóa khỏi yêu thích --}}
                        <a href="/user/deleteFavorite/{{ $item['favorite_id'] }}"
                           class="btn btn-light btn-sm rounded-circle position-absolute top-0 end-0 m-2 shadow-sm z-2 text-danger"
                           onclick="return confirm('Xóa khỏi yêu thích?')" title="Xóa">
                            <i class="fas fa-trash-alt"></i>
                        </a>

                        <a href="/product/detail/{{ $item['id'] }}">
                            <div class="product-img-wrapper rounded-top">
                                <img src="{{ $imgSrc }}" class="product-img" alt="{{ $item['name'] }}">
                            </div>
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h6 class="fw-bold text-truncate mb-1" title="{{ $item['name'] }}">
                                <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-dark">{{ $item['name'] }}</a>
                            </h6>
                            <p class="small text-muted flex-grow-1 mb-2">{{ substr($item['mota'] ?? '', 0, 70) }}...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ</span>
                                <small class="text-muted">{{ date('d/m', strtotime($item['favorite_at'])) }}</small>
                            </div>
                            <a href="/cart/add/{{ $item['id'] }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="fas fa-cart-plus me-1"></i> Thêm vào giỏ
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm mb-3"
                     style="width:90px;height:90px;">
                    <i class="fas fa-heart text-secondary" style="font-size:2.5rem;"></i>
                </div>
                <h5 class="text-muted fw-normal">Danh sách yêu thích trống</h5>
                <p class="text-secondary">Lưu những sản phẩm bạn quan tâm để xem lại sau!</p>
                <a href="/" class="btn btn-primary px-4">Tiếp tục mua sắm</a>
            </div>
        @endif

    </div>
</div>
@endsection