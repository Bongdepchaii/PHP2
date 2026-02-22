@extends('layouts.index')
@section('title', 'Đặt hàng thành công')
@section('content')

<div class="row justify-content-center">
  <div class="col-lg-7">

    {{-- Thông báo thành công --}}
    <div class="text-center mb-4">
      <div class="mb-3">
        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
      </div>
      <h4 class="fw-bold text-success">Đặt hàng thành công!</h4>
      <p class="text-muted">Cảm ơn bạn đã mua hàng. Đơn hàng <strong>#{{ $order['id'] }}</strong> đang được xử lý.</p>
    </div>

    {{-- Chi tiết đơn hàng --}}
    <div class="card mb-3">
      <div class="card-header"><strong>Thông tin giao hàng</strong></div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-md-6">
            <span class="text-muted">Người nhận:</span>
            <span class="fw-semibold ms-1">{{ $order['receiver'] }}</span>
          </div>
          <div class="col-md-6">
            <span class="text-muted">Điện thoại:</span>
            <span class="fw-semibold ms-1">{{ $order['phone'] }}</span>
          </div>
          <div class="col-12">
            <span class="text-muted">Địa chỉ:</span>
            <span class="ms-1">{{ $order['address'] }}</span>
          </div>
          @if($order['note'])
          <div class="col-12">
            <span class="text-muted">Ghi chú:</span>
            <span class="ms-1">{{ $order['note'] }}</span>
          </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="card mb-3">
      <div class="card-header"><strong>Sản phẩm đã đặt</strong></div>
      <ul class="list-group list-group-flush">
        @foreach($order['items'] as $item)
        <li class="list-group-item d-flex justify-content-between">
          <span>{{ $item['product_name'] }} <span class="text-muted">x{{ $item['quantity'] }}</span></span>
          <span class="fw-semibold">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</span>
        </li>
        @endforeach
      </ul>
      <div class="card-footer">
        <div class="d-flex justify-content-between">
          <span class="text-muted">Tạm tính:</span>
          <span>{{ number_format($order['subtotal'], 0, ',', '.') }}đ</span>
        </div>
        @if($order['discount'] > 0)
        <div class="d-flex justify-content-between text-danger">
          <span>Giảm giá ({{ $order['id_voucher'] }}):</span>
          <span>- {{ number_format($order['discount'], 0, ',', '.') }}đ</span>
        </div>
        @endif
        <div class="d-flex justify-content-between fw-bold fs-6 mt-1 border-top pt-2">
          <span>Tổng thanh toán:</span>
          <span class="text-primary">{{ number_format($order['total'], 0, ',', '.') }}đ</span>
        </div>
      </div>
    </div>

    <div class="d-flex gap-2 justify-content-center">
      <a href="/" class="btn btn-primary">
        <i class="fas fa-home me-1"></i>Tiếp tục mua sắm
      </a>
    </div>

  </div>
</div>
@endsection
