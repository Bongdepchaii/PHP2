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
    <h1 class="h4 mb-3">Chi tiết cuộc hẹn</h1>
    <a href="/booking/booking" class="nav-link mb-3">Trở về</a>
       <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Ngày hẹn</th>
                <th>Giờ hẹn</th>
              </tr>
            </thead>
            <tbody>
                  <tr>
                    <td>{{ $bk['id'] }}</td>
                    <td>{{ $bk['name'] }}</td>
                    <td>{{ $bk['phone'] }}</td>
                    <td>{{ $bk['date'] }}</td>
                    <td>{{ $bk['time'] }}</td>
                  </tr>
            </tbody>
          </table>
        </div>
      </div>
  </div>
</body>
</html>