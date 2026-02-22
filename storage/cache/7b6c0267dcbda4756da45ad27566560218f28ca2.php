<aside class="col-12 col-lg-4 mt-5">
  <div class="card shadow-sm border-0 rounded-3 mb-3">
    <div class="card-header bg-white py-3">
      <h6 class="fw-bold mb-0">TÓM TẮT ĐƠN HÀNG</h6>
    </div>
    <div class="card-body pt-0">

      
      <div class="d-flex justify-content-between mb-2 mt-3">
        <span class="text-muted">Số loại sản phẩm:</span>
        <span class="fw-semibold"><?php echo e(count($cart)); ?></span>
      </div>
      <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Tổng số lượng:</span>
        <span class="fw-semibold"><?php echo e(array_sum(array_column($cart, 'quantity'))); ?> cái</span>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Tạm tính:</span>
        <span class="fw-bold" id="sidebar-subtotal"><?php echo e(number_format($subtotal, 0, ',', '.')); ?>đ</span>
      </div>

      
      <?php if($voucherInfo): ?>
      <div class="alert alert-success py-2 px-3 d-flex justify-content-between align-items-center mb-3">
        <div>
          <i class="fas fa-tag me-1"></i>
          <strong><?php echo e($voucherInfo['id']); ?></strong>
          <br><small>Giảm <?php echo e($voucherInfo['value']); ?>% — Tiết kiệm <?php echo e(number_format($discount, 0, ',', '.')); ?>đ</small>
        </div>
        <a href="/cart/removeVoucher" class="btn btn-sm btn-outline-danger" title="Hủy voucher">
          <i class="fas fa-times"></i>
        </a>
      </div>
      <div class="d-flex justify-content-between mb-2 text-danger">
        <span>Giảm (<?php echo e($voucherInfo['value']); ?>%):</span>
        <span>- <span id="sidebar-discount"><?php echo e(number_format($discount, 0, ',', '.')); ?></span>đ</span>
      </div>
      <?php endif; ?>

      
      <button class="btn btn-outline-primary w-100 mb-3"
              data-bs-toggle="modal" data-bs-target="#voucherModal">
        <i class="fas fa-ticket-alt me-2"></i>Chọn hoặc nhập mã voucher
      </button>

      <hr class="text-muted">

      
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="h6 mb-0">Tổng cộng:</span>
        <span class="h5 mb-0 text-primary fw-bold" id="sidebar-total"><?php echo e(number_format($total, 0, ',', '.')); ?>đ</span>
      </div>

      
      <?php if(count($cart) > 0): ?>
      <button class="btn btn-primary w-100 mt-3 py-2 fw-bold"
              data-bs-toggle="modal" data-bs-target="#checkoutModal">
        <i class="fas fa-credit-card me-2"></i>THANH TOÁN NGAY
      </button>
      <?php else: ?>
      <button class="btn btn-secondary w-100 mt-3 py-2 fw-bold" disabled>
        Giỏ hàng trống
      </button>
      <?php endif; ?>

    </div>
  </div>
</aside>


<div class="modal fade" id="voucherModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header">
        <h5 class="modal-title fw-bold"><i class="fas fa-ticket-alt me-2"></i>Mã giảm giá</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        
        <form action="/cart/applyVoucher" method="POST">
          <div class="input-group mb-4">
            <input type="text" class="form-control text-uppercase" name="voucher_code"
                   placeholder="Nhập mã voucher tại đây..." required>
            <button class="btn btn-primary" type="submit">Áp dụng</button>
          </div>
        </form>

        
        <?php if(count($activeVouchers) > 0): ?>
        <h6 class="fw-bold mb-3">Voucher hiện có</h6>
        <div class="d-flex flex-column gap-2">
          <?php $__currentLoopData = $activeVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="border rounded-3 p-3 d-flex justify-content-between align-items-center">
            <div>
              <span class="fw-bold text-success d-block"><?php echo e($v['id']); ?></span>
              <small class="text-muted"><?php echo e($v['name']); ?> — Giảm <?php echo e(number_format($v['value'], 0, ',', '.')); ?>đ</small>
              <small class="text-muted d-block">HSD: <?php echo e(date('d/m/Y', strtotime($v['end_date']))); ?> | Còn <?php echo e($v['quanity']); ?> lượt</small>
            </div>
            <form action="/cart/applyVoucher" method="POST">
              <input type="hidden" name="voucher_code" value="<?php echo e($v['id']); ?>">
              <button type="submit" class="btn btn-sm btn-outline-success ms-2">Dùng ngay</button>
            </form>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <p class="text-muted text-center">Hiện không có voucher nào.</p>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form action="/cart/checkout" method="POST">
      <div class="modal-content border-0 shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold"><i class="fas fa-shipping-fast me-2"></i>Thông tin giao hàng</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          
          <?php if(isset($addresses) && count($addresses) > 0): ?>
          <div class="mb-3">
            <label class="form-label fw-semibold">Chọn địa chỉ đã lưu</label>
            <div class="d-flex flex-column gap-2" id="savedAddressList">
              <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="border rounded-3 p-2 d-flex align-items-center gap-2 saved-addr-item"
                   style="cursor:pointer"
                   data-receiver="<?php echo e($addr['receiver']); ?>"
                   data-phone="<?php echo e($addr['phone']); ?>"
                   data-address="<?php echo e($addr['address']); ?>">
                <input type="radio" name="addr_choice" value="<?php echo e($addr['id']); ?>"
                       id="addr_<?php echo e($addr['id']); ?>"
                       <?php echo e($addr['is_default'] ? 'checked' : ''); ?>>
                <label for="addr_<?php echo e($addr['id']); ?>" style="cursor:pointer" class="mb-0">
                  <span class="badge bg-secondary me-1"><?php echo e($addr['label']); ?></span>
                  <strong><?php echo e($addr['receiver']); ?></strong> — <?php echo e($addr['phone']); ?><br>
                  <small class="text-muted"><?php echo e($addr['address']); ?></small>
                </label>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-2 text-end">
              <a href="#" id="toggleManual" class="small text-primary">Nhập địa chỉ khác</a>
            </div>
          </div>
          <?php endif; ?>

          
          <div id="manualForm" <?php echo e((isset($addresses) && count($addresses) > 0) ? 'style=display:none' : ''); ?>>
            <div class="row g-2">
              <div class="col-md-6">
                <label class="form-label">Tên người nhận <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="receiver" id="inp_receiver" placeholder="Nguyễn Văn A">
              </div>
              <div class="col-md-6">
                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" id="inp_phone" placeholder="0901234567">
              </div>
              <div class="col-12">
                <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" id="inp_address"
                       placeholder="Số nhà, đường, phường, quận, tỉnh/thành phố">
              </div>
            </div>
          </div>

          <div class="mt-3">
            <label class="form-label">Ghi chú (tùy chọn)</label>
            <textarea class="form-control" name="note" rows="2" placeholder="Giao giờ hành chính, gọi trước khi giao..."></textarea>
          </div>

          
          <div class="mt-3 p-3 bg-light rounded-3">
            <div class="d-flex justify-content-between">
              <span class="text-muted">Tạm tính:</span>
              <span><?php echo e(number_format($subtotal, 0, ',', '.')); ?>đ</span>
            </div>
            <?php if($discount > 0): ?>
            <div class="d-flex justify-content-between text-danger">
              <span>Giảm giá (<?php echo e($voucherInfo['id'] ?? ''); ?>):</span>
              <span>- <?php echo e(number_format($discount, 0, ',', '.')); ?>đ</span>
            </div>
            <?php endif; ?>
            <div class="d-flex justify-content-between fw-bold fs-6 mt-1 border-top pt-2">
              <span>Tổng thanh toán:</span>
              <span class="text-primary"><?php echo e(number_format($total, 0, ',', '.')); ?>đ</span>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary fw-bold">
            <i class="fas fa-check me-1"></i> Xác nhận đặt hàng
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
// Khi chọn địa chỉ đã lưu → điền vào field ẩn / hiển thị tóm tắt
document.querySelectorAll('.saved-addr-item').forEach(function(item) {
    item.addEventListener('click', function() {
        var radio = this.querySelector('input[type=radio]');
        radio.checked = true;
        // Điền vào hidden inputs nếu người dùng đang show manual form
        var r = this.dataset.receiver;
        var p = this.dataset.phone;
        var a = this.dataset.address;
        if (document.getElementById('inp_receiver')) document.getElementById('inp_receiver').value = r;
        if (document.getElementById('inp_phone'))    document.getElementById('inp_phone').value    = p;
        if (document.getElementById('inp_address'))  document.getElementById('inp_address').value  = a;
    });
});

// Toggle manual form
var toggleBtn = document.getElementById('toggleManual');
if (toggleBtn) {
    toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var mf = document.getElementById('manualForm');
        mf.style.display = mf.style.display === 'none' ? '' : 'none';
    });
}

// Khi submit checkout: nếu chọn địa chỉ đã lưu thì điền vào form
var checkoutForm = document.querySelector('#checkoutModal form');
if (checkoutForm) {
    checkoutForm.addEventListener('submit', function() {
        var chosen = document.querySelector('input[name=addr_choice]:checked');
        if (chosen) {
            var item = chosen.closest('.saved-addr-item');
            if (item) {
                setOrCreate(checkoutForm, 'receiver', item.dataset.receiver);
                setOrCreate(checkoutForm, 'phone',    item.dataset.phone);
                setOrCreate(checkoutForm, 'address',  item.dataset.address);
            }
        }
    });
}
function setOrCreate(form, name, val) {
    var el = form.querySelector('[name=' + name + ']');
    if (el) { el.value = val; }
    else {
        var h = document.createElement('input');
        h.type = 'hidden'; h.name = name; h.value = val;
        form.appendChild(h);
    }
}
</script><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/layouts/includes/slidebar_cart.blade.php ENDPATH**/ ?>