
<?php $__env->startSection('title', 'Quản lý sản phẩm'); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header d-flex align-items-center flex-wrap gap-2">
                <h5 class="card-title me-auto mb-0">Danh sách sản phẩm
                    <span class="badge bg-soft-secondary text-secondary ms-2"><?php echo e($total); ?></span>
                </h5>
                
                <form method="GET" action="/product" class="d-flex gap-2 align-items-center">
                    <div class="input-group input-group-sm" style="width:240px;">
                        <input type="text" class="form-control" name="q"
                               placeholder="Tìm tên sản phẩm..."
                               value="<?php echo e($keyword); ?>">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="feather-search"></i>
                        </button>
                        <?php if($keyword): ?>
                        <a href="/product" class="btn btn-outline-danger" title="Xóa tìm kiếm">
                            <i class="feather-x"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-plus me-1"></i> Thêm sản phẩm
                </a>
            </div>
              <?php echo $__env->make('layouts.includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <?php
                                $catMap = array_column($categories, 'name', 'id');
                                $colorMap = array_column($colors, 'name', 'id');
                            ?>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($item['id']); ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-image avatar-md me-3">
                                            <?php
                                                $images = json_decode($item['img'], true);
                                                $displayImg = is_array($images) && !empty($images) ? $images[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                                                if (empty($displayImg)) {
                                                    $imgSrc = "https://picsum.photos/50/50?random=" . $item['id'];
                                                } else {
                                                    $imgSrc = "/app/images/img/" . $displayImg;
                                                }
                                            ?>
                                            <img src="<?php echo e($imgSrc); ?>" alt="" class="img-fluid" style="border-radius: 5px; object-fit: cover; width: 50px; height: 50px;">
                                        </div>
                                        <div>
                                            <span class="fw-bold text-dark d-block"><?php echo e($item['name']); ?></span>
                                            <small class="text-muted">SL: <?php echo e($item['quantity'] ?? 0); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-semibold text-danger"><?php echo e(number_format($item['price'], 0, ',', '.')); ?>đ</td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">
                                        <?php echo e($catMap[$item['id_category']]); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php echo e($colorMap[$item['id_color']]); ?>

                                </td>
                                <td class="text-muted text-truncate" style="max-width: 300px;">
                                    <?php echo e(substr($item['mota'], 0, 80) . (strlen($item['mota']) > 80 ? '...' : '')); ?>

                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?php echo e(date('d/m/Y', strtotime($item['created_at']))); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <?php
                                            // Giải mã ảnh giống detail.blade.php
                                            $editImgs    = json_decode($item['img'], true);
                                            $editMain    = is_array($editImgs) && !empty($editImgs) ? $editImgs[0] : (is_string($item['img']) && !empty($item['img']) ? $item['img'] : '');
                                            $editGallery = is_array($editImgs) && count($editImgs) > 1 ? array_slice($editImgs, 1) : [];
                                        ?>
                                        <a href="javascript:void(0);"
                                           class="avatar-text avatar-md"
                                           data-bs-toggle="modal"
                                           data-bs-target="#modalEdit"
                                           data-id="<?php echo e($item['id']); ?>"
                                           data-name="<?php echo e($item['name']); ?>"
                                           data-price="<?php echo e($item['price']); ?>"
                                           data-quantity="<?php echo e($item['quantity'] ?? ''); ?>"
                                           data-mota="<?php echo e($item['mota'] ?? ''); ?>"
                                           data-img-main="<?php echo e($editMain); ?>"
                                           data-img-gallery="<?php echo e(json_encode($editGallery, JSON_HEX_QUOT | JSON_HEX_APOS)); ?>"
                                           data-idcategory="<?php echo e($item['id_category'] ?? ''); ?>"
                                           data-idtrademark="<?php echo e($item['id_trademark'] ?? ''); ?>"
                                           data-idcolor="<?php echo e($item['id_color'] ?? ''); ?>"
                                           data-variants="<?php echo e(json_encode($item['variants'] ?? [], JSON_HEX_QUOT | JSON_HEX_APOS)); ?>"
                                           title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/product/delete/<?php echo e($item['id']); ?>" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn có muốn xoá sản phẩm này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(empty($products)): ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="feather-package fs-1 display-6 d-block mb-2"></i>
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <?php if($totalPage > 1): ?>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-2">
                <small class="text-muted">
                    Hiển <?php echo e(($page - 1) * $perPage + 1); ?>&ndash;<?php echo e(min($page * $perPage, $total)); ?>

                    trong tổng <?php echo e($total); ?> sản phẩm
                    <?php if($keyword): ?><span class="ms-1">cho &ldquo;<strong><?php echo e($keyword); ?></strong>&rdquo;</span><?php endif; ?>
                </small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        
                        <li class="page-item <?php echo e($page <= 1 ? 'disabled' : ''); ?>">
                            <a class="page-link" href="/product?page=<?php echo e($page - 1); ?>&q=<?php echo e(urlencode($keyword)); ?>">
                                <i class="feather-chevron-left"></i>
                            </a>
                        </li>
                        
                        <?php for($p = max(1, $page - 2); $p <= min($totalPage, $page + 2); $p++): ?>
                        <li class="page-item <?php echo e($p === $page ? 'active' : ''); ?>">
                            <a class="page-link" href="/product?page=<?php echo e($p); ?>&q=<?php echo e(urlencode($keyword)); ?>"><?php echo e($p); ?></a>
                        </li>
                        <?php endfor; ?>
                        
                        <li class="page-item <?php echo e($page >= $totalPage ? 'disabled' : ''); ?>">
                            <a class="page-link" href="/product?page=<?php echo e($page + 1); ?>&q=<?php echo e(urlencode($keyword)); ?>">
                                <i class="feather-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('modals'); ?>
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
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat['id']); ?>"><?php echo e($cat['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hãng sản xuất</label>
                            <select class="form-select" name="id_trademark">
                                <option value="">-- Chọn hãng --</option>
                                <?php $__currentLoopData = $trademarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tm['id']); ?>"><?php echo e($tm['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($col['id']); ?>"><?php echo e($col['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        
                        <!-- Biến thể (Variants) -->
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0 fw-bold">Các phiên bản (Variants)</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddVariant">
                                    <i class="feather-plus"></i> Thêm phiên bản
                                </button>
                            </div>
                            <div id="variantContainer">
                                <!-- Các dòng variant sẽ được thêm vào đây bằng JS -->
                            </div>
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
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat['id']); ?>"><?php echo e($cat['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hãng sản xuất</label>
                            <select class="form-select" id="trademarkEdit" name="id_trademark">
                                <option value="">-- Chọn hãng --</option>
                                <?php $__currentLoopData = $trademarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tm['id']); ?>"><?php echo e($tm['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($col['id']); ?>"><?php echo e($col['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                        <!-- Edit Biến thể (Variants) -->
                        <div class="col-md-12 mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0 fw-bold">Các phiên bản (Variants)</label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btnAddVariantEdit">
                                    <i class="feather-plus"></i> Thêm phiên bản
                                </button>
                            </div>
                            <div id="variantContainerEdit">
                                <!-- Các dòng variant cũ/mới sẽ được load vào đây khi chọn sản phẩm -->
                            </div>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
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

    // Logic xử lý thêm dòng Variant
    document.getElementById('btnAddVariant').addEventListener('click', function() {
        const container = document.getElementById('variantContainer');
        const row = document.createElement('div');
        row.className = 'row mb-2 align-items-end border p-2 rounded bg-light variant-row';
        row.innerHTML = `
            <div class="col-md-3">
                <label class="form-label small">Màu sắc</label>
                <select class="form-select form-select-sm" name="variant_id_color[]">
                    <option value="">-- Chọn màu --</option>
                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($col['id']); ?>"><?php echo e($col['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small">ROM/Bộ nhớ</label>
                <select class="form-select form-select-sm" name="variant_id_rom[]">
                    <option value="">-- Chọn ROM --</option>
                    <?php if(isset($roms)): ?>
                        <?php $__currentLoopData = $roms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rom['id']); ?>"><?php echo e($rom['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Giá bán</label>
                <input type="number" class="form-control form-control-sm" name="variant_price[]" value="0" required>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Số lượng</label>
                <input type="number" class="form-control form-control-sm" name="variant_quantity[]" value="0" required>
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-sm btn-outline-danger btnRemoveVariant" title="Xóa">
                    <i class="feather-trash-2"></i>
                </button>
            </div>
        `;
        container.appendChild(row);

        // Bắt sự kiện cho nút xóa ở dòng vừa tạo
        row.querySelector('.btnRemoveVariant').addEventListener('click', function() {
            row.remove();
        });
    });

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

        // ---- Hiển thị ảnh (PHP đã tính sẵn, JS chỉ gán src) ----
        const previewMain    = document.getElementById('previewMainImgEdit');
        const previewGallery = document.getElementById('previewGalleryImgEdit');
        previewMain.innerHTML    = '';
        previewGallery.innerHTML = '';

        // Ảnh chính
        const mainSrc = button.getAttribute('data-img-main');
        if (mainSrc) {
            const mainImg = document.createElement('img');
            mainImg.src         = '/app/images/img/' + mainSrc;
            mainImg.className   = 'img-fluid rounded shadow-sm';
            mainImg.style.maxHeight = '150px';
            previewMain.appendChild(mainImg);
        } else {
            previewMain.innerHTML = '<span class="text-muted small">Không có ảnh cũ</span>';
        }

        // Ảnh gallery
        const galleryRaw = button.getAttribute('data-img-gallery');
        let galleryImgs = [];
        try { galleryImgs = JSON.parse(galleryRaw) || []; } catch(e) {}

        if (galleryImgs.length > 0) {
            galleryImgs.forEach(function(img) {
                const tag = document.createElement('img');
                tag.src         = '/app/images/img/' + img;
                tag.className   = 'rounded shadow-sm border me-1 mb-1';
                tag.style.cssText = 'width:80px;height:80px;object-fit:cover;';
                previewGallery.appendChild(tag);
            });
        } else {
            previewGallery.innerHTML = '<span class="text-muted small w-100 text-center my-auto">Chưa có gallery</span>';
        }

        // --- LOAD DỮ LIỆU VARIANTS CŨ VÀO FORM SỬA ---
        const variantContainerEdit = document.getElementById('variantContainerEdit');
        variantContainerEdit.innerHTML = ''; // xóa rỗng lúc trước
        
        let variants = [];
        try { 
            let vRaw = button.getAttribute('data-variants') || "[]";
            variants = JSON.parse(vRaw); 
        } catch(e) {}

        if (variants && variants.length > 0) {
            variants.forEach(function(v) {
                appendVariantRowForEdit(variantContainerEdit, v.id_color, v.id_rom, v.price, v.quantity);
            });
        }
    });

    // --- ADD VARIANT CHO FORM SỬA ---
    document.getElementById('btnAddVariantEdit').addEventListener('click', function() {
        const container = document.getElementById('variantContainerEdit');
        appendVariantRowForEdit(container, "", "", 0, 0);
    });

    // Utils html cho variant Edit
    function appendVariantRowForEdit(container, colorId, romId, price, quantity) {
        const row = document.createElement('div');
        row.className = 'row mb-2 align-items-end border p-2 rounded bg-light variant-row';
        
        // Render thẻ HTML cho select box
        // Bắt buộc loop màu, rom từ DB để đổ ra option
        let colorOptions = `<option value="">-- Chọn màu --</option>`;
        <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            colorOptions += `<option value="<?php echo e($col['id']); ?>" ${colorId == <?php echo e($col['id']); ?> ? 'selected' : ''}><?php echo e($col['name']); ?></option>`;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        let romOptions = `<option value="">-- Chọn ROM --</option>`;
        <?php if(isset($roms)): ?>
            <?php $__currentLoopData = $roms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                romOptions += `<option value="<?php echo e($rom['id']); ?>" ${romId == <?php echo e($rom['id']); ?> ? 'selected' : ''}><?php echo e($rom['name']); ?></option>`;
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        row.innerHTML = `
            <div class="col-md-3">
                <label class="form-label small">Màu sắc</label>
                <select class="form-select form-select-sm" name="variant_id_color[]">
                    ${colorOptions}
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small">ROM/Bộ nhớ</label>
                <select class="form-select form-select-sm" name="variant_id_rom[]">
                    ${romOptions}
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Giá bán</label>
                <input type="number" class="form-control form-control-sm" name="variant_price[]" value="${price}" required>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Số lượng</label>
                <input type="number" class="form-control form-control-sm" name="variant_quantity[]" value="${quantity}" required>
            </div>
            <div class="col-md-1 text-end">
                <button type="button" class="btn btn-sm btn-outline-danger btnRemoveVariantEdit" title="Xóa">
                    <i class="feather-trash-2"></i>
                </button>
            </div>
        `;
        container.appendChild(row);

        row.querySelector('.btnRemoveVariantEdit').addEventListener('click', function() {
            row.remove();
        });
    }

    // Validate Form: Phải có ít nhất 1 option cho variant (Màu hoặc ROM)
    document.addEventListener('submit', function(e) {
        if(e.target.tagName === 'FORM' && (e.target.action.includes('/product/add') || e.target.action.includes('/product/update'))) {
            const rows = e.target.querySelectorAll('.variant-row');
            for(let i=0; i<rows.length; i++) {
                const color = rows[i].querySelector('select[name="variant_id_color[]"]').value;
                const rom = rows[i].querySelector('select[name="variant_id_rom[]"]').value;
                if (!color && !rom) {
                    e.preventDefault();
                    alert("Vui lòng chọn ít nhất Màu sắc hoặc ROM cho tất cả các phiên bản (Variants)!");
                    return false;
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.index_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/products/index.blade.php ENDPATH**/ ?>