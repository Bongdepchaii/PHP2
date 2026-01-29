@extends('layouts.index')
@section('title', 'Quản lý danh mục')
@section('content')

<div class="row g-3">
    <!-- Product Card -->
        @foreach ($category as $item)
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="card h-100 shadow-sm">
            <img src="https://picsum.photos/600/400?random=1" class="card-img-top" alt="Product">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <h5 class="card-title mb-1"></h5>
                    <span class="badge text-bg-primary">Máy ảnh</span>
                </div>
                <p class="card-text text-muted small mb-2">{{ substr($item['mota'], 0, 80) . "..." }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-semibold">{{ $item['price'] }}</div>
                    <a href="#" class="btn btn-sm btn-outline-primary">Xem</a>
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