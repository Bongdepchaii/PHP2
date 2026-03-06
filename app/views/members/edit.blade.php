<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Quản lý thành viên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Quản lý thành viên</h4>
    <a class="btn btn-outline-secondary btn-sm" href="/members">Làm mới</a>
  </div>
  @include('layouts.includes.notification')

  <!-- FORM: tạo/sửa -->
  <form method="post" action="/member/edit/{{ $member['id'] }}" enctype="multipart/form-data" class="row g-3 mb-4">
    <!-- Nếu edit: action="/members/{id}/update" + hidden input id -->

    <div class="col-md-2">
      <label class="form-label">Đời *</label>
      <input type="number" name="gen" class="form-control" value="{{ $member['gen'] }}" required>
    </div>

    <div class="col-md-5">
      <label class="form-label">Họ tên *</label>
      <input type="text" name="name" class="form-control" value="{{ $member['name'] }}" required>
    </div>

    <div class="col-md-5">
      <label class="form-label">Chi/Nhánh</label>
      <input type="text" name="branch" class="form-control" value="{{ $member['branch'] }}">
    </div>

    <div class="col-md-3">
      <label class="form-label">Năm sinh</label>
      <input type="date" name="birth" class="form-control" value="{{ $member['birth'] ? date('Y-m-d', strtotime($member['birth'])) : '' }}">
    </div>

    <div class="col-md-3">
      <label class="form-label">Năm mất</label>
      <input type="date" name="death" class="form-control"value="{{ $member['death'] ? date('Y-m-d', strtotime($member['death'])) : '' }}"">
    </div>

    <div class="col-md-6">
      <label class="form-label">Vợ/Chồng</label>
      <input type="text" name="spouse" class="form-control" value="{{ $member ['spouse'] }}">
    </div>

    <div class="col-md-6">
      <label class="form-label">Hình đại diện (tuỳ chọn)</label>
      <input type="file" name="avatar" class="form-control" accept="image/*">
      {{-- <div class="form-text">Backend nên giới hạn: jpg/png/webp, max 2MB.</div> --}}
    </div>

    <div class="col-md-6">
      <label class="form-label">Cha (ID)</label>
      <input type="text" name="father_id" class="form-control" value="{{ $member ['father_id'] }}">
    </div>

    <div class="col-12">
      <label class="form-label">Ghi chú</label>
      <textarea name="note" class="form-control" rows="12">{{ $member['note'] }}</textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Sửa</button>
      <a href="/member" class="btn btn-outline-secondary">Quay lại</a>
    </div>
  </form>
</div>
</body>
</html>