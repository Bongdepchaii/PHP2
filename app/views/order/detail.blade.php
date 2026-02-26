@extends('layouts.index_admin')
@section('title', $title)
@section('content')

@php
$statusMap = [
    'pending'   => ['label' => 'Chờ xử lý',  'color' => 'warning'],
    'confirmed' => ['label' => 'Đã xác nhận','color' => 'info'],
    'shipping'  => ['label' => 'Đang giao',  'color' => 'primary'],
    'done'      => ['label' => 'Hoàn thành', 'color' => 'success'],
    'cancelled' => ['label' => 'Đã hủy',     'color' => 'danger'],
];
$s = $statusMap[$order['status']] ?? ['label' => $order['status'], 'color' => 'secondary'];
@endphp

<div class="d-flex justify-content-between align-items-center mb-4 ms-4 mt-5">
    <h4 class="fw-bold mb-0">Đơn hàng #{{ $order['id'] }}</h4>
    <a href="/order" class="btn btn-outline-secondary btn-sm me-4">
        <i class="fas fa-arrow-left me-1"></i>Quay lại
    </a>
</div>

<div class="row g-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white fw-bold">Thông tin giao hàng</div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6"><span class="text-muted">Người nhận:</span> <strong>{{ $order['receiver'] }}</strong></div>
                    <div class="col-12"><span class="text-muted">Điện thoại:</span> {{ $order['phone'] }}</div>
                    <div class="col-12"><span class="text-muted">Địa chỉ:</span> {{ $order['address'] }}</div>
                    @if($order['note'])<div class="col-12"><span class="text-muted">Ghi chú:</span> {{ $order['note'] }}</div>@endif
                    <div class="col-12"><span class="text-muted">Ngày đặt:</span> {{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</div>
                    <div class="col-12"><span class="text-muted">Trạng thái:</span> <span class="badge bg-{{ $s['color'] }}">{{ $s['label'] }}</span></div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Sản phẩm</div>
            <ul class="list-group list-group-flush">
                @foreach($order['items'] as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                        <span class="fw-semibold">{{ $item['product_name'] }}</span>
                        <span class="text-muted ms-2">x{{ $item['quantity'] }}</span>
                    </div>
                    <span class="fw-bold">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
                </li>
                @endforeach
            </ul>
            <div class="card-footer bg-white">
                <div class="d-flex justify-content-between text-muted">
                    <span>Tạm tính:</span>
                    <span>{{ number_format($order['subtotal'], 0, ',', '.') }}đ</span>
                </div>
                @if($order['discount'] > 0)
                <div class="d-flex justify-content-between text-danger">
                    <span>Giảm giá {{ $order['id_voucher'] ? '('.$order['id_voucher'].')' : '' }}:</span>
                    <span>- {{ number_format($order['discount'], 0, ',', '.') }}đ</span>
                </div>
                @endif
                <div class="d-flex justify-content-between fw-bold fs-6 border-top mt-1 pt-2">
                    <span>Tổng thanh toán:</span>
                    <span class="text-primary">{{ number_format($order['total'], 0, ',', '.') }}đ</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
