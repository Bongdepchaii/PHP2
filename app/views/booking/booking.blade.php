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
    <h1 class="h4 mb-3">Cuộc hẹn của tôi</h1>
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
                      <a href="detail/{{ $item['id'] }}" type="button" class="btn btn-sm btn-warning">Xem chi tiết</a>
                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
</body>
</html>