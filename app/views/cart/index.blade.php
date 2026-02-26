@extends('layouts.index_cart')
@section('title', 'Giỏ hàng')
@section('content')



<div class="py-2">
    <h4 class="fw-bold mb-4">GIỎ HÀNG (<span>{{ count($cart) }}</span> sản phẩm)</h4>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-0">
            @if(empty($cart))
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png"
                         alt="Empty Cart" style="width: 150px;" class="mb-3 opacity-50">
                    <h5 class="text-muted">Giỏ hàng của bạn đang trống</h5>
                    <a href="/" class="btn btn-primary mt-3 px-4">Tiếp tục mua sắm</a>
                </div>
            @else
                <div class="d-none d-md-flex bg-light p-3 fw-bold text-muted small border-bottom">
                    <div style="flex: 2;">SẢN PHẨM</div>
                    <div style="flex: 1;" class="text-center">ĐƠN GIÁ</div>
                    <div style="flex: 1;" class="text-center">SỐ LƯỢNG</div>
                    <div style="flex: 1;" class="text-end">THÀNH TIỀN</div>
                </div>

                @foreach($cart as $item)
                @php
                    $images     = json_decode($item['img'], true);
                    $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                    $imgSrc     = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://via.placeholder.com/80";
                @endphp
                <div class="p-3 border-bottom align-items-center d-flex flex-column flex-md-row cart-row"
                     data-cart-id="{{ $item['id'] }}"
                     data-price="{{ $item['price'] }}"
                     data-stock="{{ $item['stock'] }}">

                    <div class="d-flex align-items-center w-100" style="flex: 2;">
                        <a href="product/detail/{{ $item['id_product'] }}" class="nav-link"><img src="{{ $imgSrc }}" class="rounded-2 border"
                             alt="{{ $item['product_name'] }}"
                             style="width: 80px; height: 80px; object-fit: cover;"></a>
                        <div class="ms-3">
                            <a href="product/detail/{{ $item['id_product'] }}" class="nav-link"><h6 class="mb-1 fw-bold">{{ $item['product_name'] }}</h6></a>
                            <small>SL: {{ $item['stock'] }}</small><br>
                            <a href="/cart/delete/{{ $item['id'] }}"
                               class="btn btn-link btn-sm p-0 text-danger text-decoration-none mt-1"
                               onclick="return confirm('Xóa sản phẩm này?')">
                               <i class="fas fa-trash-alt me-1"></i>Xóa
                            </a>
                        </div>
                    </div>

                    <div class="text-center w-100 mt-2 mt-md-0" style="flex: 1;">
                        <span class="fw-semibold">{{ number_format($item['price'], 0, ',', '.') }}đ</span>
                    </div>
                    <div class="d-flex flex-column align-items-center justify-content-center w-100 mt-2 mt-md-0" style="flex: 1;">
                        <div class="input-group input-group-sm" style="width: 110px;">
                            <button class="btn btn-outline-secondary btn-qty-minus"
                                    type="button"
                                    data-cart-id="{{ $item['id'] }}"
                                    {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>−</button>
                            <input type="text" class="form-control text-center qty-input"
                                   value="{{ $item['quantity'] }}"
                                   data-cart-id="{{ $item['id'] }}"
                                   readonly style="max-width: 45px;">
                            <button class="btn btn-outline-secondary btn-qty-plus"
                                    type="button"
                                    data-cart-id="{{ $item['id'] }}"
                                    {{ $item['quantity'] >= $item['stock'] ? 'disabled' : '' }}>+</button>
                        </div>
                    </div>

                    {{-- Thành tiền --}}
                    <div class="text-end w-100 mt-2 mt-md-0" style="flex: 1;">
                        <span class="fw-bold text-primary item-total"
                              data-price="{{ $item['price'] }}">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                        </span>
                    </div>

                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@include('layouts.includes.notification')
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Hàm format số sang dạng 1.000.000
    function fmt(n) {
        return Math.round(n).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Cập nhật sidebar tổng tiền qua API
    function refreshSidebar(data) {
        var el;
        el = document.getElementById('sidebar-count');
        if (el) el.textContent = data.count + ' cái';
        el = document.getElementById('sidebar-subtotal');
        if (el) el.textContent = fmt(data.subtotal) + 'đ';
        el = document.getElementById('sidebar-discount');
        if (el) el.textContent = fmt(data.discount);
        el = document.getElementById('sidebar-total');
        if (el) el.textContent = fmt(data.total) + 'đ';
    }

    // Gọi API updateQuantity
    function updateQty(cartId, qty, row) {
        fetch('/cart/updateQuantity/' + cartId, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'quantity=' + qty
        })
        .then(r => r.json())
        .then(data => {
            var input     = row.querySelector('.qty-input');
            var plusBtn   = row.querySelector('.btn-qty-plus');
            var minusBtn  = row.querySelector('.btn-qty-minus');
            var stockBadge = row.querySelector('.stock-badge');
            var price     = parseFloat(row.dataset.price);

            var realQty = (data.qty !== undefined) ? data.qty : qty;
            input.value = realQty;

            var totalEl = row.querySelector('.item-total');
            if (totalEl) totalEl.textContent = fmt(price * realQty) + 'đ';

            // xu ly trang thai nut + dua tren ton kho
            if (data.stock !== null && data.stock !== undefined) {
                row.dataset.stock = data.stock;
                if (data.max_reached || realQty >= data.stock) {
                    if (plusBtn) plusBtn.disabled = true;
                    if (stockBadge) {
                        stockBadge.classList.add('text-danger', 'fw-semibold');
                        stockBadge.classList.remove('text-muted');
                    }
                    if (data.max_reached) {
                        // Toast nhẹ thông báo đã đạt giới hạn
                        showStockToast('Đã đạt số lượng tối đa trong kho (' + data.stock + ' cái)');
                    }
                } else {
                    if (plusBtn) plusBtn.disabled = false;
                    if (stockBadge) {
                        stockBadge.classList.remove('text-danger', 'fw-semibold');
                        stockBadge.classList.add('text-muted');
                    }
                }
            }

            // Xử lý nút minus
            if (minusBtn) minusBtn.disabled = (realQty <= 1);

            // Cập nhật sidebar
            refreshSidebar(data);
        })
        .catch(err => console.error('Lỗi cập nhật số lượng:', err));
    }

    // toast thong bao gioi han ton kho
    function showStockToast(msg) {
        var existing = document.getElementById('stock-toast');
        if (existing) existing.remove();
        var toast = document.createElement('div');
        toast.id = 'stock-toast';
        toast.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:9999;'
            + 'background:#fff3cd;color:#856404;border:1px solid #ffc107;'
            + 'border-radius:8px;padding:12px 18px;font-size:14px;'
            + 'box-shadow:0 4px 12px rgba(0,0,0,.15);display:flex;align-items:center;gap:8px;';
        toast.innerHTML = '<i class="fas fa-exclamation-triangle"></i><span>' + msg + '</span>';
        document.body.appendChild(toast);
        setTimeout(function() { toast.style.opacity='0'; toast.style.transition='opacity .4s'; }, 2200);
        setTimeout(function() { toast.remove(); }, 2700);
    }

    document.querySelectorAll('.btn-qty-minus').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var cartId   = this.dataset.cartId;
            var row      = this.closest('.cart-row');
            var input    = row.querySelector('.qty-input');
            var plusBtn  = row.querySelector('.btn-qty-plus');
            var qty      = parseInt(input.value);
            if (qty <= 1) return;
            qty--;
            input.value = qty;
            if (qty <= 1) this.disabled = true;
            // neu giam xuong thi luon bat lai nut +
            if (plusBtn) plusBtn.disabled = false;
            var stockBadge = row.querySelector('.stock-badge');
            if (stockBadge) {
                stockBadge.classList.remove('text-danger', 'fw-semibold');
                stockBadge.classList.add('text-muted');
            }
            updateQty(cartId, qty, row);
        });
    });

    document.querySelectorAll('.btn-qty-plus').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var cartId  = this.dataset.cartId;
            var row     = this.closest('.cart-row');
            var input   = row.querySelector('.qty-input');
            var stock   = parseInt(row.dataset.stock);
            var qty     = parseInt(input.value);

            // validate phia client truoc khi goi API
            if (!isNaN(stock) && qty >= stock) {
                showStockToast('Đã đạt số lượng tối đa trong kho (' + stock + ' cái)');
                this.disabled = true;
                return;
            }

            qty++;
            input.value = qty;
            var minusBtn = row.querySelector('.btn-qty-minus');
            if (minusBtn) minusBtn.disabled = false;
            updateQty(cartId, qty, row);
        });
    });

});
</script>
@endpush