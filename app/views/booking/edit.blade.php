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
    <section class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="/booking/edit/{{ $booking['id'] }}" method="post" class="row g-3">
          <div class="col-12 col-md-6">
            <label for="customerName" class="form-label">Họ tên khách hàng</label>
            <input id="customerName" type="text" class="form-control" name="name" placeholder="Nhập họ tên" value="{{  $booking['name']}}" />
          </div>

          <div class="col-12 col-md-6">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input name="phone" id="phone" type="tel" class="form-control" placeholder="0901xxxxxx" value=" {{ $booking['phone'] }}" />
          </div>

          <div class="col-12 col-md-6">
            <label for="bookingDate" class="form-label">Ngày hẹn</label>
            <input name="date" id="bookingDate" type="date" class="form-control" value="{{ $booking['date'] ? date('Y-m-d', strtotime($booking['date'])) : '' }}" />
          </div>

          <div class="col-12 col-md-6">
            <label for="bookingTime" class="form-label">Giờ hẹn</label>
            <input name="time" id="bookingTime" type="time" class="form-control" value="{{ $booking['time'] ? date('H:i:s', strtotime($booking['time'])) : '' }}" />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Tạo lịch hẹn</button>
            <a href="/booking" class="btn btn-outline-secondary">Trở về</a>
          </div>
        </form>
      </div>
    </section>
  </div>
</body>
</html>