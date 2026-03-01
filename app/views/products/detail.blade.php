@extends('layouts.index')
@section('title', $title)
@section('content')

<div class="row">
    <!-- Breadcrumb (Optional) -->
    <div class="col-12 mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/home">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
            </ol>
        </nav>
    </div>

    <!-- Product Detail Section -->
    <div class="col-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-5 mb-4 mb-md-0">
                         @php
                            $images = json_decode($product['img'], true);
                            $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($product['img']) && !empty($product['img']) ? $product['img'] : '');
                            $imgSrc = !empty($displayImg) ? "/app/images/img/" . $displayImg : "https://picsum.photos/600/400?random=" . $product['id'];
                        @endphp
                        <div class="border rounded p-2 mb-2">
                             <img src="{{ $imgSrc }}" class="img-fluid w-100 rounded" alt="{{ $product['name'] }}" style="object-fit: contain; max-height: 400px;">
                        </div>
                        @if(is_array($images) && count($images) > 1)
                        <div class="d-flex gap-2 overflow-auto">
                            @foreach($images as $img)
                            <div style="width: 80px; height: 80px;" class="border rounded p-1 cursor-pointer">
                                 <img src="/app/images/img/{{ $img }}" class="w-100 h-100" style="object-fit: cover;" onclick="document.querySelector('.img-fluid').src=this.src">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="col-md-7">
                        <h3 class="fw-bold mb-3">{{ $product['name'] }}</h3>
                        <div class="d-flex align-items-center mb-3">
                            <span id="detail-price-text" class="h4 text-danger fw-bold me-3">{{ number_format($product['price'], 0, ',', '.') }}đ</span>
                            @if(isset($product['quantity']) && $product['quantity'] > 0)
                                <span id="detail-status-badge" class="badge bg-success">Còn hàng</span>
                            @else
                                <span id="detail-status-badge" class="badge bg-danger">Hết hàng</span>
                            @endif
                        </div>
                        <span class="card-title mb-2 fw-bold text-truncate">
                            @php
                                $totalSystemQty = $product['quantity'] ?? 0;
                                if (isset($variants) && count($variants) > 0) {
                                    $totalSystemQty += array_sum(array_column($variants, 'quantity'));
                                }
                            @endphp
                            <span id="detail-quantity-text" class="fs-5">Số lượng: {{ $totalSystemQty }}</span>
                        </span>

                        <p class="text-muted mb-4 mt-3">
                            {{ $product['mota'] ?? 'Chưa có mô tả cho sản phẩm này.' }}
                        </p>

                        <!-- Chọn Option (Variants) -->
                        <div class="mb-4">
                            @if(isset($variants) && count($variants) > 0)
                                @php
                                    // Tạo mảng unique color và rom để hiển thị
                                    $availableColors = [];
                                    $availableRoms = [];
                                    foreach($variants as $v) {
                                        if(!empty($v['id_color']) && !in_array($v['id_color'], array_column($availableColors, 'id'))) {
                                            $colName = '';
                                            foreach($allColors as $c) { if($c['id'] == $v['id_color']) { $colName = $c['name']; break; } }
                                            $availableColors[] = ['id' => $v['id_color'], 'name' => $colName];
                                        }
                                        if(!empty($v['id_rom']) && !in_array($v['id_rom'], array_column($availableRoms, 'id'))) {
                                            $romName = '';
                                            foreach($allRoms as $r) { if($r['id'] == $v['id_rom']) { $romName = $r['name']; break; } }
                                            $availableRoms[] = ['id' => $v['id_rom'], 'name' => $romName];
                                        }
                                    }
                                @endphp

                                @if(!empty($availableColors))                             
                                <label class="fw-bold mb-2">Chọn màu sắc:</label>
                                <div class="d-flex gap-2 mb-3 flex-wrap" id="colorOptions">
                                    @foreach($availableColors as $c)
                                        <button type="button" class="btn btn-outline-secondary btn-color-select variant-btn" data-type="color" data-id="{{ $c['id'] }}">
                                            {{ $c['name'] }}
                                        </button>
                                    @endforeach
                                </div>
                                @endif
                                @if(!empty($availableRoms))
                                <label class="fw-bold mb-2">Chọn phiên bản (ROM):</label>
                                <div class="d-flex gap-2 mb-3 flex-wrap" id="romOptions">
                                    @foreach($availableRoms as $r)
                                        <button type="button" class="btn btn-outline-secondary btn-rom-select variant-btn" data-type="rom" data-id="{{ $r['id'] }}">
                                            {{ $r['name'] }}
                                        </button>
                                    @endforeach
                                </div>
                                @endif
                                <div id="variantAlert" class="text-danger small fw-bold mb-2 d-none">Vui lòng chọn đầy đủ Màu sắc và ROM!</div>
                            @endif
                        </div>

                        <div class="d-flex gap-2 mb-4">
                             <!-- Thay the link bang the action form hoac js, o day se ap dung JS -->
                             <a href="javascript:voild(0);" onclick="addToCart(event, {{ $product['id'] }})" class="btn btn-primary btn-lg px-4" id="btnAddToCart">
                                <i class="fas fa-cart-plus me-2"></i> Thêm vào giỏ
                            </a>
                            <a href="/user/addFavorite/{{ $product['id'] }}" class="btn btn-outline-danger btn-lg" title="Yêu thích">
                                <i class="far fa-heart"></i>
                            </a>
                        </div>

                        <div class="border-top pt-3">
                            <p><small class="text-muted">Mã sản phẩm: #{{ $product['id'] }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="col-12 mt-4">
        <h4 class="mb-3 fw-bold border-bottom pb-2">Sản phẩm liên quan</h4>
        <div class="row g-3">
            @php
            if (!class_exists('QtyHelperRelated')) {
                class QtyHelperRelated extends Model {
                    public function getTotalQty($product) {
                        $total = $product['quantity'] ?? 0;
                        try {
                            $stmt = $this->connect()->prepare("SELECT SUM(quantity) FROM variant WHERE id_product = ?");
                            $stmt->execute([$product['id']]);
                            $total += (int)$stmt->fetchColumn();
                        } catch (\Exception $e) {}
                        return $total;
                    }
                }
            }
            $qtyHelperRelated = new QtyHelperRelated();
            @endphp
             @forelse ($relatedProducts as $item)
            <div class="col-6 col-md-3">
                 <div class="card h-100 shadow-sm border-0 product-card">
                    @php
                        $rImages = json_decode($item['img'], true);
                        $rDisplayImg = is_array($rImages) && !empty($rImages) ? $rImages[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $rImgSrc = !empty($rDisplayImg) ? "/app/images/img/" . $rDisplayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    @endphp
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/{{ $item['id'] }}">
                            <img src="{{ $rImgSrc }}" class="position-absolute top-0 start-0 w-100 h-100" alt="{{ $item['name'] }}" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-dark">{{ $item['name'] }}</a>
                        </span>
                        <span class="card-title mb-2 fw-bold text-truncate">
                            <span>Số lượng: {{ $qtyHelperRelated->getTotalQty($item) }}</span>
                        </span>
                        <div class="mt-auto pt-2">
                             <div class="fw-bold text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 p-3 text-muted">Không có sản phẩm liên quan nào.</div>
            @endforelse
        </div>
    </div>
</div>


@if(isset($recentProducts) && count($recentProducts) > 0)
<div class="row mt-4">
    <div class="col-12">
        <h4 class="mb-3 fw-bold border-bottom pb-2 mt-3">
            Đã xem gần đây
        </h4>
        <div class="row g-3">
            @foreach($recentProducts as $item)
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    @php
                        $rImages = json_decode($item['img'], true);
                        $rDisplayImg = is_array($rImages) && !empty($rImages) ? $rImages[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                        $rImgSrc = !empty($rDisplayImg) ? "/app/images/img/" . $rDisplayImg : "https://picsum.photos/600/400?random=" . $item['id'];
                    @endphp
                    <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                        <a href="/product/detail/{{ $item['id'] }}">
                            <img src="{{ $rImgSrc }}" class="position-absolute top-0 start-0 w-100 h-100" alt="{{ $item['name'] }}" style="object-fit: contain; padding: 10px;">
                        </a>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-dark">{{ $item['name'] }}</a>
                        </h6>
                        <span class="card-title mb-1 fw-bold text-truncate">
                            <a href="/product/detail/{{ $item['id'] }}" class="text-decoration-none text-dark">Số lượng: {{ $qtyHelperRelated->getTotalQty($item) }}</a>
                        </span>
                        <div class="mt-auto pt-2">
                            <div class="fw-bold text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<style>
    .cursor-pointer { cursor: pointer; }
    .cursor-pointer:hover { border-color: #0d6efd !important; }
    .variant-btn.active {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
    }
</style>

<script>
    // du lieu sang ajax
    const variants = {!! json_encode($variants ?? []) !!};
    const defaultPrice = {{ $product['price'] }};
    const defaultQuantity = {{ isset($totalSystemQty) ? $totalSystemQty : ($product['quantity'] ?? 0) }};
    const hasVariants = variants.length > 0;
    
    let selectedColor = null;
    let selectedRom = null;

    // xu ly click variant
    document.querySelectorAll('.variant-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const id = this.getAttribute('data-id');

            // xoa active
            document.querySelectorAll(`.variant-btn[data-type="${type}"]`).forEach(b => b.classList.remove('active'));
            // them active
            this.classList.add('active');

            if(type === 'color') selectedColor = id;
            if(type === 'rom') selectedRom = id;

            checkAndUpdatePrice();
        });
    });

    function checkAndUpdatePrice() {
        if (!hasVariants) return; // Nếu ko có variant thì ko lam gi

        // an canh bao
        document.getElementById('variantAlert').classList.add('d-none');
        
        let foundVariant = null;

        // neu da chon du ca 2
        if (selectedColor && selectedRom) {
            foundVariant = variants.find(v => v.id_color == selectedColor && v.id_rom == selectedRom);
        } else if (selectedColor && !selectedRom) {
            // truong hop user chi can chon mau (khong co rom)
            foundVariant = variants.find(v => v.id_color == selectedColor);
        } else if (!selectedColor && selectedRom) {
             foundVariant = variants.find(v => v.id_rom == selectedRom);
        }

        const priceEl = document.getElementById('detail-price-text');
        const badgeEl = document.getElementById('detail-status-badge');
        const qtyEl = document.getElementById('detail-quantity-text');

        if (foundVariant) {
            const finalPrice = foundVariant.price && foundVariant.price > 0 ? foundVariant.price : defaultPrice;
            priceEl.innerHTML = new Intl.NumberFormat('vi-VN').format(finalPrice) + 'đ';
            
            // inner text check quantity variant
            if (foundVariant.quantity > 0) {
                badgeEl.className = "badge bg-success";
                badgeEl.innerText = "Còn hàng";
            } else {
                badgeEl.className = "badge bg-danger";
                badgeEl.innerText = "Hết hàng";
            }
            qtyEl.innerHTML = `Số lượng: ${foundVariant.quantity}`;
        } else {
            priceEl.innerHTML = new Intl.NumberFormat('vi-VN').format(defaultPrice) + 'đ';
            qtyEl.innerHTML = `Số lượng: ${defaultQuantity}`;
            if (selectedColor && selectedRom) {
               // da chon du nhung ko thay trong db
               badgeEl.className = "badge bg-danger";
               badgeEl.innerText = "Hết hàng/Ngừng kinh doanh bản này";
            }
        }
    }

    function addToCart(e, productId) {
        if (hasVariants) {
            const needsColor = document.getElementById('colorOptions') !== null;
            const needsRom = document.getElementById('romOptions') !== null;

            let missingOption = false;
            if (needsColor && !selectedColor) missingOption = true;
            if (needsRom && !selectedRom) missingOption = true;

            if (missingOption) {
                e.preventDefault();
                // hien thi canh bao
                document.getElementById('variantAlert').classList.remove('d-none');
                return false;
            }
            
            // tim variant id
            const variantId = variants.find(v => v.id_color == selectedColor && v.id_rom == selectedRom)?.id || '';
            // them query params hoac chuyen huong URL
            window.location.href = `/cart/add/${productId}?variant_id=${variantId}`;
        } else {
            // san pham thong thuong
            window.location.href = `/cart/add/${productId}`;
        }
    }
</script>
@endpush
