<!-- Thương hiệu -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-award me-2"></i>Thương hiệu</h5>
    </div>
    <div class="card-body">
         <div class="list-group list-group-flush">
            <a href="/" class="list-group-item border-0 rounded list-group-item-action active">Tất cả</a>
            @if(isset($trademarks))
                @foreach($trademarks as $brand)
                <a href="/home/index?id_trademark={{ $brand['id'] }}" class="list-group-item list-group-item-action {{ (isset($selectedTrademark) && $selectedTrademark == $brand['id']) ? 'active bg-primary' : '' }}">{{ $brand['name'] }}</a>
                @endforeach
            @endif
         </div>
    </div>
</div>

<!-- Danh mục -->
<div class="card shadow-sm border-0 mb-3">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-list-ul me-2"></i>Danh mục</h5>
    </div>
    <div class="card-body">
        <div class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action border-0 rounded mb-1 {{ !isset($selectedCategory) ? 'active bg-primary' : '' }}">
                <i class="fas fa-th-large me-2"></i>Tất cả sản phẩm
            </a>
            @if(isset($categories) && is_array($categories))
                @foreach($categories as $cat)
                    <a href="/home/index?id_category={{ $cat['id'] }}" 
                       class="list-group-item list-group-item-action border-0 rounded mb-1 {{ (isset($selectedCategory) && $selectedCategory == $cat['id']) ? 'active bg-primary' : '' }}">
                        <i class="fas fa-angle-right me-2 small"></i>{{ $cat['name'] }}
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Lọc giá -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
        <h5 class="card-title fw-bold"><i class="fas fa-filter me-2"></i>Lọc giá</h5>
    </div>
    <div class="card-body">
         <div class="d-flex gap-2 mb-3">
              <input type="number" class="form-control form-control-sm" placeholder="Từ">
              <input type="number" class="form-control form-control-sm" placeholder="Đến">
         </div>
         <button class="btn btn-primary w-100 btn-sm">Áp dụng</button>
    </div>
</div>