<!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Quản lý thành viên</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-0">Quản lý thành viên</h4>
      <a class="btn btn-outline-secondary btn-sm" href="/member">Làm mới</a>
    </div>
    @include('layouts.includes.notification')

    <!-- FORM  -->
    <form method="post" action="/member/add" enctype="multipart/form-data" class="row g-3 mb-4">

      <div class="col-md-2">
        <label class="form-label">Đời *</label>
        <input type="number" name="gen" class="form-control" required>
      </div>

      <div class="col-md-5">
        <label class="form-label">Họ tên *</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="col-md-5">
        <label class="form-label">Chi/Nhánh</label>
        <input type="text" name="branch" class="form-control">
      </div>

      <div class="col-md-3">
        <label class="form-label">Năm sinh</label>
        <input type="date" name="birth" class="form-control">
      </div>

      <div class="col-md-3">
        <label class="form-label">Năm mất</label>
        <input type="date" name="death" class="form-control">
      </div>

      <div class="col-md-6">
        <label class="form-label">Vợ/Chồng</label>
        <input type="text" name="spouse" class="form-control">
      </div>

      <div class="col-md-6">
        <label class="form-label">Hình đại diện (tuỳ chọn)</label>
        <input type="file" name="avatar" class="form-control" accept="image/*">
        {{-- <div class="form-text">Backend nên giới hạn: jpg/png/webp, max 2MB.</div> --}}
      </div>

      <div class="col-md-6">
        <label class="form-label">Cha (ID)</label>
        <input type="text" name="father_id" class="form-control">
      </div>

      <div class="col-12">
        <label class="form-label">Ghi chú</label>
        <textarea name="note" class="form-control" rows="2"></textarea>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary">Lưu</button>
        <button type="reset" class="btn btn-outline-secondary">Reset</button>
      </div>
    </form>

    <!-- SEARCH -->
    <form method="get" action="/member" class="row g-2 align-items-end mb-3">
      <div class="col-sm-8 col-md-6">
        <label class="form-label">Tìm kiếm</label>
        <input type="text" name="q" class="form-control" placeholder="Tên / chi / đời / ghi chú..."
          value="{{ $_GET['q'] ?? '' }}">
      </div>
      <div class="col-sm-4 col-md-2">
        <button class="btn btn-outline-primary w-100">Tìm</button>
      </div>
    </form>

    <!-- TABLE -->
    <div class="table-responsive">
      <table class="table table-bordered table-sm align-middle">
        <thead class="table-light">
          <tr>
            <th width="70">ID</th>
            <th width="70">Đời</th>
            <th width="70">Ảnh</th>
            <th>Họ tên</th>
            <th width="200">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <!-- Backend loop -->
          @foreach ($members as $mb)
            <tr>
              <td>{{ $mb['id'] }}</td>
              <td>{{ $mb['gen'] }}</td>
              <td>
                <img src="/app/images/img/{{ $mb['img'] }}" alt="{{ $mb['name'] }}" width="40" height="40"
                  class="rounded object-fit-cover">
              </td>
              <td>{{ $mb['name'] }}</td>
              <td>
                <a class="btn btn-sm btn-outline-primary" href="/member/edit/{{ $mb['id'] }}">Sửa</a>
                <a href="member/delete/{{ $mb['id'] }}" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip"
                  title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xoá thành viên này?');">
                  Xoá
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
       <div class="d-flex flex-column align-items-center mt-4 gap-2">
            @if($totalPage > 1)
            <nav>
                <ul class="pagination mb-0">
                    {{-- Prev --}}
                    {{-- <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="/member?page={{ $page - 1 }}&q={{ urlencode($keyword) }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li> --}}
                    {{-- Number pages --}}
                    @for($p = max(1, $page - 2); $p <= min($totalPage, $page + 2); $p++)
                    <li class="page-item {{ $p === $page ? 'active' : '' }}">
                        <a class="page-link" href="/member?page={{ $p }}&q={{ urlencode($keyword) }}">{{ $p }}</a>
                    </li>
                    @endfor
                    {{-- Next --}}
                    {{-- <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                        <a class="page-link" href="/member?page={{ $page + 1 }}&q={{ urlencode($keyword) }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li> --}}
                </ul>
            </nav>
            @endif
        </div>
    </div>

  </div>
</body>

</html>