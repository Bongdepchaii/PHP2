<aside class="col-12 col-lg-4 mt-5">
  <div class="card shadow-sm border-0 rounded-3 mb-3">
    <div class="card-header bg-white py-3 border-bottom-0">
      <h6 class="fw-bold mb-0">TÓM TẮT ĐƠN HÀNG</h6>
    </div>
    <div class="card-body pt-0">
      <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Tổng sản phẩm:</span>
        <span class="fw-semibold">03</span>
      </div>
      <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Số lượng:</span>
        <span class="fw-semibold">05 cái</span>
      </div>
      <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Tạm tính:</span>
        <span class="fw-bold text-danger">35.000.000đ</span>
      </div>

      <button class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center gap-2 mb-3" 
              data-bs-toggle="modal" data-bs-target="#voucherModal">
        <i class="bi bi-ticket-perforated"></i> Chọn hoặc nhập mã
      </button>

      <hr class="text-muted">
      
      <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="h6 mb-0">Tổng cộng:</span>
        <span class="h5 mb-0 text-primary fw-bold">34.500.000đ</span>
      </div>
      
      <button class="btn btn-primary w-100 mt-3 py-2 fw-bold text-uppercase">
        Thanh toán ngay
      </button>
    </div>
  </div>
</aside>

<div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold" id="voucherModalLabel">Mã giảm giá</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-4">
          <input type="text" class="form-control" placeholder="Nhập mã voucher tại đây..." aria-label="Voucher code">
          <button class="btn btn-primary" type="button">Áp dụng</button>
        </div>

        <h6 class="fw-bold mb-3">Voucher hiện có</h6>
        
        <div class="list-group gap-2">
          <div class="list-group-item list-group-item-action rounded-3 border p-3">
            <div class="d-flex w-100 justify-content-between align-items-center">
              <div>
                <h6 class="mb-1 fw-bold text-success">GIAM200K</h6>
                <small class="text-muted">Giảm 200.000đ cho đơn từ 10tr</small>
              </div>
              <button class="btn btn-sm btn-outline-success">Dùng ngay</button>
            </div>
          </div>
          
          <div class="list-group-item list-group-item-action rounded-3 border p-3">
            <div class="d-flex w-100 justify-content-between align-items-center">
              <div>
                <h6 class="mb-1 fw-bold text-primary">FREESHIP</h6>
                <small class="text-muted">Miễn phí vận chuyển toàn quốc</small>
              </div>
              <button class="btn btn-sm btn-outline-primary">Dùng ngay</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH C:\xampp\htdocs\PHP2\app\views/layouts/includes/slidebar_cart.blade.php ENDPATH**/ ?>