@extends('layouts.index_admin')
@section('title', 'Quản lý sản phẩm')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách sản phẩm</h5>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-plus me-1"></i> Thêm sản phẩm
                </a>
            </div>
              @include('layouts.includes.notification')
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col" style="min-width: 200px;">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Màu sắc</th>
                                <th scope="col" style="max-width: 300px;">Mô tả</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $catMap = array_column($categories, 'name', 'id');
                                $colorMap = array_column($colors, 'name', 'id');
                            @endphp
                            @foreach ($products as $item)
                            <tr>
                                <td class="text-center">{{ $item['id'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-image avatar-md me-3">
                                            @php
                                                $images = json_decode($item['img'], true);
                                                $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                                                if (empty($displayImg)) {
                                                    $imgSrc = "https://picsum.photos/50/50?random=" . $item['id'];
                                                } else {
                                                    $imgSrc = "/app/images/img/" . $displayImg;
                                                }
                                            @endphp
                                            <img src="{{ $imgSrc }}" alt="" class="img-fluid" style="border-radius: 5px; object-fit: cover; width: 50px; height: 50px;">
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block">{{ $item['name'] }}</span>
                                            <small class="text-muted">SL: {{ $item['quantity'] ?? 0 }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">
                                        {{ $catMap[$item['id_category']]}}
                                    </span>
                                </td>
                                <td>
                                    {{ $colorMap[$item['id_color']]}}
                                </td>
                                <td class="text-muted text-truncate" style="max-width: 300px;">
                                    {{ substr($item['mota'], 0, 80) . (strlen($item['mota']) > 80 ? '...' : '') }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ date('d/m/Y', strtotime($item['created_at'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" 
                                           class="avatar-text avatar-md" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#modalEdit"
                                           data-id="{{ $item['id'] }}"
                                           data-name="{{ $item['name'] }}"
                                           data-price="{{ $item['price'] }}"
                                           data-quantity="{{ $item['quantity'] ?? '' }}"
                                           data-mota="{{ $item['mota'] ?? '' }}"
                                           data-img="{{ htmlspecialchars($item['img'], ENT_QUOTES, 'UTF-8') }}"
                                           data-idcategory="{{ $item['id_category'] ?? '' }}"
                                           data-idtrademark="{{ $item['id_trademark'] ?? '' }}"
                                           data-idcolor="{{ $item['id_color'] ?? '' }}"
                                           title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/product/delete/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn có muốn xoá sản phẩm này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(empty($products))
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="feather-package fs-1 display-6 d-block mb-2"></i>
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('modals')
<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="/product/add" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="id_category" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hãng sản xuất</label>
                            <select class="form-select" name="id_trademark">
                                <option value="">-- Chọn hãng --</option>
                                @foreach($trademarks as $tm)
                                    <option value="{{ $tm['id'] }}">{{ $tm['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" class="form-control" name="quantity">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Màu sắc</label>
                            <select class="form-select" name="id_color">
                                <option value="">-- Chọn màu --</option>
                                @foreach($colors as $col)
                                    <option value="{{ $col['id'] }}">{{ $col['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ảnh đại diện (1 ảnh)</label>
                            <input type="file" class="form-control" name="main_img" id="inputMainImg" required onchange="previewImage(this, 'previewMainImg')">
                            <div id="previewMainImg" class="mt-2 text-center" style="min-height: 100px; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center;">
                                <span class="text-muted small">Chưa có ảnh</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ảnh gallery (Có thể chọn nhiều)</label>
                            <input type="file" class="form-control" name="gallery_img[]" id="inputGalleryImg" multiple onchange="previewGallery(this, 'previewGalleryImg')">
                            <div id="previewGalleryImg" class="mt-2 d-flex flex-wrap gap-2" style="min-height: 100px; border: 1px dashed #ddd; padding: 10px;">
                                <span class="text-muted small w-100 text-center my-auto">Chưa có ảnh</span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="mota" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Cập nhật sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="nameEdit" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" id="catEdit" name="id_category" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hãng sản xuất</label>
                            <select class="form-select" id="trademarkEdit" name="id_trademark">
                                <option value="">-- Chọn hãng --</option>
                                @foreach($trademarks as $tm)
                                    <option value="{{ $tm['id'] }}">{{ $tm['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giá</label>
                            <input type="number" class="form-control" id="priceEdit" name="price" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="number" class="form-control" id="quantityEdit" name="quantity">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Màu sắc</label>
                            <select class="form-select" id="colorEdit" name="id_color">
                                <option value="">-- Chọn màu --</option>
                                @foreach($colors as $col)
                                    <option value="{{ $col['id'] }}">{{ $col['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ảnh đại diện (Thay thế ảnh cũ)</label>
                            <input type="file" class="form-control" name="main_img" id="inputMainImgEdit" onchange="previewImage(this, 'previewMainImgEdit')">
                            <div id="previewMainImgEdit" class="mt-2 text-center" style="min-height: 100px; border: 1px dashed #ddd; display: flex; align-items: center; justify-content: center;">
                                <span class="text-muted small">Ảnh hiện tại sẽ hiển thị ở đây (nếu có)</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ảnh gallery (Thay thế gallery cũ)</label>
                            <input type="file" class="form-control" name="gallery_img[]" id="inputGalleryImgEdit" multiple onchange="previewGallery(this, 'previewGalleryImgEdit')">
                            <div id="previewGalleryImgEdit" class="mt-2 d-flex flex-wrap gap-2" style="min-height: 100px; border: 1px dashed #ddd; padding: 10px;">
                                <span class="text-muted small w-100 text-center my-auto">Gallery hiện tại sẽ hiển thị ở đây (nếu có)</span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" id="motaEdit" name="mota" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush

@push('scripts')
<script>
    // Preview Single Image
    function previewImage(input, targetId) {
        const target = document.getElementById(targetId);
        target.innerHTML = ''; // Clear current

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                target.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">`;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            target.innerHTML = '<span class="text-muted small">Chưa có ảnh</span>';
        }
    }

    // Preview Gallery Images
    function previewGallery(input, targetId) {
        const target = document.getElementById(targetId);
        target.innerHTML = ''; // Clear current

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'rounded shadow-sm border';
                    img.style.width = '80px';
                    img.style.height = '80px';
                    img.style.objectFit = 'cover';
                    target.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        } else {
            target.innerHTML = '<span class="text-muted small w-100 text-center my-auto">Chưa có ảnh</span>';
        }
    }

    const modalEdit = document.getElementById('modalEdit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        
        // Update form action
        const formEdit = modalEdit.querySelector('#formEdit');
        formEdit.action = `/product/update/${id}`;
        
        // Fill fields
        modalEdit.querySelector('#nameEdit').value = button.getAttribute('data-name');
        modalEdit.querySelector('#priceEdit').value = button.getAttribute('data-price');
        modalEdit.querySelector('#quantityEdit').value = button.getAttribute('data-quantity');
        modalEdit.querySelector('#motaEdit').value = button.getAttribute('data-mota');
        modalEdit.querySelector('#catEdit').value = button.getAttribute('data-idcategory');
        modalEdit.querySelector('#trademarkEdit').value = button.getAttribute('data-idtrademark');
        modalEdit.querySelector('#colorEdit').value = button.getAttribute('data-idcolor');

        // Handle Existing Images Preview
        const imgData = button.getAttribute('data-img');
        const previewMain = document.getElementById('previewMainImgEdit');
        const previewGallery = document.getElementById('previewGalleryImgEdit');
        
        previewMain.innerHTML = '';
        previewGallery.innerHTML = '';

        try {
            let images = JSON.parse(imgData);
            if (!Array.isArray(images) && images) images = [images]; // Handle string case

            if (images && images.length > 0) {
                // Main Image (Index 0)
                const mainImgSrc = "/app/images/img/" + images[0];
                previewMain.innerHTML = `<img src="${mainImgSrc}" class="img-fluid rounded shadow-sm" style="max-height: 150px;">`;

                // Gallery (Index 1+)
                if (images.length > 1) {
                    images.slice(1).forEach(img => {
                         const imgTag = document.createElement('img');
                        imgTag.src = "/app/images/img/" + img;
                        imgTag.className = 'rounded shadow-sm border';
                        imgTag.style.width = '80px';
                        imgTag.style.height = '80px';
                        imgTag.style.objectFit = 'cover';
                        previewGallery.appendChild(imgTag);
                    });
                } else {
                     previewGallery.innerHTML = '<span class="text-muted small w-100 text-center my-auto">Chưa có gallery</span>';
                }
            } else {
                previewMain.innerHTML = '<span class="text-muted small">Không có ảnh cũ</span>';
                previewGallery.innerHTML = '<span class="text-muted small w-100 text-center my-auto">Chưa có gallery</span>';
            }
        } catch (e) {
            console.error("Error parsing images", e);
             previewMain.innerHTML = '<span class="text-muted small">Lỗi hiển thị ảnh</span>';
        }
    });
</script>
@endpush