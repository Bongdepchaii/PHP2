@extends('layouts.index')
@section('title', $title ?? 'Tài khoản')
@section('content')

<div class="row g-4">

    {{-- Sidebar navigation --}}
    @include('layouts.includes.user_nav', ['user' => $user, 'activeTab' => 'profile'])

    {{-- Nội dung chính --}}
    <div class="col-12 col-md-9">

        @include('layouts.includes.notification')

        {{-- ===== TAB: THÔNG TIN + ĐỊA CHỈ ===== --}}
        {{-- Thông tin cá nhân --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-user me-2 text-primary"></i>Thông tin cá nhân</h6>
            </div>
            <div class="card-body">
                <form action="/auth/profile" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $user['name'] }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user['email'] }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tuổi</label>
                            <input type="number" class="form-control" name="age" value="{{ $user['age'] ?? '' }}" min="0" max="120">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Giới tính</label>
                            <select class="form-select" name="sex">
                                <option value="Male"   {{ ($user['sex'] ?? '') == 'Male'   ? 'selected' : '' }}>Nam</option>
                                <option value="Female" {{ ($user['sex'] ?? '') == 'Female' ? 'selected' : '' }}>Nữ</option>
                                <option value="Other"  {{ ($user['sex'] ?? '') == 'Other'  ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i>Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sổ địa chỉ --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="fas fa-map-marker-alt me-2 text-danger"></i>Sổ địa chỉ</h6>
                <button class="btn btn-sm btn-success p-2" data-bs-toggle="modal" data-bs-target="#modalAddAddress">
                    Thêm
                </button>
            </div>
            <div class="card-body p-0">
                @if(isset($addresses) && count($addresses) > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($addresses as $addr)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-secondary me-1">{{ $addr['label'] }}</span>
                                    @if($addr['is_default'])<span class="badge bg-primary me-1">Mặc định</span>@endif
                                    <strong>{{ $addr['receiver'] }}</strong> — {{ $addr['phone'] }}
                                    <br><small class="text-muted">{{ $addr['address'] }}</small>
                                </div>
                                <div class="d-flex gap-2 flex-shrink-0 ms-2">
                                    @if(!$addr['is_default'])
                                    <a href="/user/setDefaultAddress/{{ $addr['id'] }}"
                                       class="btn btn-sm btn-outline-primary" title="Đặt mặc định"
                                       onclick="return confirm('Đặt làm mặc định?')">
                                        <i class="fas fa-star"></i>
                                    </a>
                                    @endif
                                    <a href="/user/deleteAddress/{{ $addr['id'] }}"
                                       class="btn btn-sm btn-outline-danger" title="Xóa"
                                       onclick="return confirm('Xóa địa chỉ này?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-map-marker-alt fs-3 d-block mb-2 p-3 text-secondary"></i>
                        Chưa có địa chỉ nào. Hãy thêm mới!
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection

@push('modals')
<div class="modal fade" id="modalAddAddress" tabindex="-1">
    <div class="modal-dialog">
        <form action="/user/addAddress" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Thêm địa chỉ mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nhãn địa chỉ</label>
                        <select class="form-select" name="label">
                            <option value="Nhà riêng">Nhà riêng</option>
                            <option value="Văn phòng">Văn phòng</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên người nhận <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="receiver" required placeholder="Nguyễn Văn A">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" required placeholder="0901234567">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ chi tiết <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address" rows="3" required
                            placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>Lưu địa chỉ
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush
