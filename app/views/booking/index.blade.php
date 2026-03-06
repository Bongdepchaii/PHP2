<!doctype html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form đặt lịch hẹn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  @include('layouts.includes.notification')
  <div class="container py-4">
    <h1 class="h4 mb-3">Đặt lịch cuộc hẹn</h1>
    <a href="/booking/booking">Trang chủ</a>

    <section class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="/booking/add" method="post" class="row g-3">
          <div class="col-12 col-md-6">
            <label for="customerName" class="form-label">Họ tên khách hàng</label>
            <input id="customerName" type="text" class="form-control" name="name" placeholder="Nhập họ tên" />
          </div>

          <div class="col-12 col-md-6">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input name="phone" id="phone" type="tel" class="form-control" placeholder="0901xxxxxx" />
          </div>

          <div class="col-12 col-md-6">
            <label for="bookingDate" class="form-label">Ngày hẹn</label>
            <input name="date" type="date" class="form-control" />
          </div>

          <div class="col-12 col-md-6">
            <label for="bookingTime" class="form-label">Giờ hẹn</label>
            <input name="time" id="bookingTime" type="time" class="form-control" />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Tạo lịch hẹn</button>
            <button type="reset" class="btn btn-outline-secondary">Làm mới</button>
          </div>
        </form>
      </div>
    </section>

    <section class="card shadow-sm">
      <div class="card-body">
        <div class="mb-3">
          <label for="searchBooking" class="form-label">Tìm kiếm</label>
          <div class="input-group">
            <input id="searchBooking" type="text" class="form-control"
              placeholder="Tìm theo tên hoặc số điện thoại..." />
            <button type="button" class="btn btn-primary">Search</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Ngày hẹn</th>
                <th>Giờ hẹn</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($booking as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['phone'] }}</td>
                    <td>{{ $item['date'] }}</td>
                    <td>{{ $item['time'] }}</td>
                    <td>
                      <a href="booking/edit/{{ $item['id'] }}" type="button" class="btn btn-sm btn-warning">Sửa</a>
                      <a href="booking/delete/{{ $item['id'] }}" type="button" class="btn btn-sm btn-danger">Xóa</a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</body>

</html>