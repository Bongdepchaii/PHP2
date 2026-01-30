
<?php $__env->startSection('title', 'Giỏ hàng'); ?>
<?php $__env->startSection('content'); ?>

<div class="container py-4">
    <h4 class="fw-bold mb-4">GIỎ HÀNG (<span class="text-primary">1</span> sản phẩm)</h4>
    
    <div class="row g-4">
        <div class="col-12 col-lg-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <?php if(empty($products)): ?>
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" alt="Empty Cart" style="width: 150px;" class="mb-3 opacity-50">
                            <h5 class="text-muted">Giỏ hàng của bạn đang trống</h5>
                            <a href="/" class="btn btn-primary mt-3 px-4">Tiếp tục mua sắm</a>
                        </div>
                    <?php else: ?>
                        <div class="d-none d-md-flex bg-light p-3 fw-bold text-muted small border-bottom">
                            <div style="flex: 2;">SẢN PHẨM</div>
                            <div style="flex: 1;" class="text-center">ĐƠN GIÁ</div>
                            <div style="flex: 1;" class="text-center">SỐ LƯỢNG</div>
                            <div style="flex: 1;" class="text-end">THÀNH TIỀN</div>
                        </div>

                        <div class="p-3 border-bottom align-items-center d-flex flex-column flex-md-row">
                            <div class="d-flex align-items-center w-100" style="flex: 2;">
                                <img src="https://via.placeholder.com/80" class="rounded-2 border" alt="Canon R50">
                                <div class="ms-3">
                                    <h6 class="mb-1 fw-bold">Canon EOS R50</h6>
                                    <p class="small text-muted mb-0">Chính hãng / Đen</p>
                                    <button class="btn btn-link btn-sm p-0 text-danger text-decoration-none mt-1">Xóa</button>
                                </div>
                            </div>
                            <div class="text-center w-100 mt-2 mt-md-0" style="flex: 1;">
                                <span class="fw-semibold">17.890.000đ</span>
                            </div>
                            <div class="d-flex justify-content-center w-100 mt-2 mt-md-0" style="flex: 1;">
                                <div class="input-group input-group-sm" style="width: 100px;">
                                    <button class="btn btn-outline-secondary">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                            <div class="text-end w-100 mt-2 mt-md-0" style="flex: 1;">
                                <span class="fw-bold text-primary">17.890.000đ</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Xử lý JS cho nút tăng giảm số lượng nếu cần
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index_cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PHP2\app\views/cart/index.blade.php ENDPATH**/ ?>