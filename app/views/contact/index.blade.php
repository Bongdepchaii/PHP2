@extends('layouts.index')
@section('title', 'Liên hệ với chúng tôi')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
           @include('layouts.includes.notification')
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="fw-bold mb-1 text-center">Liên hệ với chúng tôi</h2>
                    <p class="text-muted text-center mb-4">Có thắc mắc? Hãy gửi tin nhắn, chúng tôi sẽ phản hồi sớm nhất!</p>

                    @php $old = $_SESSION['contact_old'] ?? []; unset($_SESSION['contact_old']); @endphp

                    <form action="/contact/add" method="POST" novalidate id="contactForm">
                        <div class="row g-3">
                            {{-- Họ tên --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name"
                                       placeholder="Nguyễn Văn A"
                                       value="{{ $old['full_name'] ?? '' }}" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email"
                                       placeholder="email@example.com"
                                       value="{{ $old['email'] ?? '' }}" required>
                            </div>

                            {{-- Số điện thoại --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone"
                                       placeholder="0912 345 678"
                                       value="{{ $old['phone'] ?? '' }}" required>
                            </div>

                            {{-- Chủ đề --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Chủ đề <span class="text-danger">*</span></label>
                                <select class="form-select" name="subject" required>
                                    <option value="" disabled {{ empty($old['subject']) ? 'selected' : '' }}>-- Chọn chủ đề --</option>
                                    @foreach(['Đặt hàng & Giao hàng','Đổi trả & Hoàn tiền','Sản phẩm','Tài khoản','Khác'] as $opt)
                                    <option value="{{ $opt }}" {{ ($old['subject'] ?? '') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Nội dung --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Nội dung <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="5"
                                          placeholder="Nhập nội dung tin nhắn của bạn (tối thiểu 10 ký tự)..." required>{{ $old['message'] ?? '' }}</textarea>
                            </div>

                            {{-- Submit --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                    <i class="fas fa-paper-plane me-2"></i>Gửi tin nhắn
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Cards --}}
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-primary text-primary rounded-circle mx-auto mb-3">
                                <i class="fas fa-envelope fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Email</h6>
                            <p class="text-muted small mb-0">contact@tbs.vn</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-success text-success rounded-circle mx-auto mb-3">
                                <i class="fas fa-phone fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Hotline</h6>
                            <p class="text-muted small mb-0">0912 345 678</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <div class="card-body py-4">
                            <div class="avatar-text avatar-lg bg-soft-warning text-warning rounded-circle mx-auto mb-3">
                                <i class="fas fa-map-marker-alt fs-5"></i>
                            </div>
                            <h6 class="fw-bold">Địa chỉ</h6>
                            <p class="text-muted small mb-0">123 Đường ABC, TP.HCM</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection