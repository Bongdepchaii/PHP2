@extends('layouts.index_admin')
@section('title', $title)
@section('content')

@php
$statusList = [
    'all'       => ['label' => 'Tất cả',       'icon' => 'list',          'color' => 'secondary'],
    'pending'   => ['label' => 'Chờ xử lý',    'icon' => 'clock',         'color' => 'warning'],
    'confirmed' => ['label' => 'Đã xác nhận',  'icon' => 'check-circle',  'color' => 'info'],
    'shipping'  => ['label' => 'Đang giao',    'icon' => 'truck',         'color' => 'primary'],
    'done'      => ['label' => 'Hoàn thành',   'icon' => 'check-double',  'color' => 'success'],
    'cancelled' => ['label' => 'Đã hủy',       'icon' => 'times-circle',  'color' => 'danger'],
];

// Nút chuyển trạng thái tiếp theo
$nextStatus = [
    'pending'   => 'confirmed',
    'confirmed' => 'shipping',
    'shipping'  => 'done',
];
@endphp

<div class="d-flex justify-content-between align-items-center mb-4 mt-5 ms-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-clipboard-list me-2"></i>Quản lý đơn hàng</h4>
</div>

<ul class="nav nav-pills mb-4 gap-1 flex-wrap ms-4">
    @foreach($statusList as $key => $info)
    @php
        $count = ($key === 'all') ? array_sum($counts) : ($counts[$key] ?? 0);
        $href  = ($key === 'all') ? '/order/index' : '/order/index?status=' . $key;
        $isActive = ($key === 'all' && !$activeStatus) || ($key === $activeStatus);
    @endphp
    <li class="nav-item">
        <a class="nav-link {{ $isActive ? 'active' : 'text-dark bg-light' }}" href="{{ $href }}">
            <i class="fas fa-{{ $info['icon'] }} me-1"></i>
            {{ $info['label'] }}
            <span class="badge {{ $isActive ? 'bg-white text-dark' : 'bg-'.$info['color'] }} ms-1">{{ $count }}</span>
        </a>
    </li>
    @endforeach
</ul>

@include('layouts.includes.notification')

{{-- Bảng đơn hàng --}}
@if(count($orders) > 0)
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#ID</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ giao</th>
                    <th class="text-end">Tổng tiền</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                @php
                    $s    = $statusList[$order['status']] ?? ['label' => $order['status'], 'icon' => 'circle', 'color' => 'secondary'];
                    $next = $nextStatus[$order['status']] ?? null;
                    $nextInfo = $next ? $statusList[$next] : null;
                @endphp
                <tr>
                    <td>
                        <span class="fw-bold">#{{ $order['id'] }}</span>
                        <br><small class="text-muted">{{ date('d/m/Y H:i', strtotime($order['created_at'])) }}</small>
                    </td>
                    <td>
                        <span class="fw-semibold">{{ $order['user_name'] }}</span>
                        <br><small class="text-muted">{{ $order['user_email'] }}</small>
                        <br><small>{{ $order['receiver'] }} — {{ $order['phone'] }}</small>
                    </td>
                    <td>
                        <small>{{ $order['address'] }}</small>
                        @if($order['note'])
                        <br><small class="text-muted fst-italic">{{ $order['note'] }}</small>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($order['discount'] > 0)
                        <small class="text-muted text-decoration-line-through d-block">{{ number_format($order['subtotal'], 0, ',', '.') }}đ</small>
                        @endif
                        <span class="fw-bold text-primary">{{ number_format($order['total'], 0, ',', '.') }}đ</span>
                        @if($order['id_voucher'])
                        <br><small class="badge bg-light text-success border">{{ $order['id_voucher'] }}</small>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge bg-{{ $s['color'] }} px-2 py-1">
                            <i class="fas fa-{{ $s['icon'] }} me-1"></i>{{ $s['label'] }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            {{-- Xem chi tiết --}}
                            <a href="/order/detail/{{ $order['id'] }}"
                               class="btn btn-sm btn-outline-secondary" title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                            {{-- Chuyển sang trạng thái tiếp theo --}}
                            @if($nextInfo)
                            <form action="/order/updateStatus/{{ $order['id'] }}" method="POST" class="d-inline">
                                <input type="hidden" name="status" value="{{ $next }}">
                                <input type="hidden" name="from_status" value="{{ $activeStatus }}">
                                <button type="submit" class="btn btn-sm btn-{{ $nextInfo['color'] }}"
                                        title="{{ $nextInfo['label'] }}"
                                        onclick="return confirm('Chuyển sang: {{ $nextInfo['label'] }}?')">
                                    <i class="fas fa-arrow-right me-1"></i>{{ $nextInfo['label'] }}
                                </button>
                            </form>
                            @endif
                            {{-- Hủy đơn (chỉ khi pending hoặc confirmed) --}}
                            @if(in_array($order['status'], ['pending', 'confirmed']))
                            <form action="/order/updateStatus/{{ $order['id'] }}" method="POST" class="d-inline">
                                <input type="hidden" name="status" value="cancelled">
                                <input type="hidden" name="from_status" value="{{ $activeStatus }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Hủy đơn #{{ $order['id'] }}?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5 text-muted">
        <i class="fas fa-inbox fs-1 d-block mb-3"></i>
        Không có đơn hàng nào trong mục này
    </div>
</div>
@endif

@endsection
