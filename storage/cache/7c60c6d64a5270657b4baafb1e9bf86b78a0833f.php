<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form tạo phim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="h4 mb-3">Tạo phim</h1>

    <section class="card shadow-sm mb-4">
      <div class="card-body">
        <form class="row g-3">
          <div class="col-12 col-md-6">
            <label for="movieName" class="form-label">Tên phim</label>
            <input id="movieName" type="text" class="form-control" placeholder="Nhập tên phim" />
          </div>

          <div class="col-12 col-md-6">
            <label for="genre" class="form-label">Thể loại</label>
            <input id="genre" type="text" class="form-control" placeholder="Ví dụ: Hành động" />
          </div>

          <div class="col-12 col-md-6">
            <label for="releaseYear" class="form-label">Năm phát hành</label>
            <input id="releaseYear" type="number" class="form-control" placeholder="2026" />
          </div>

          <div class="col-12 col-md-6">
            <label for="duration" class="form-label">Thời lượng (phút)</label>
            <input id="duration" type="number" class="form-control" placeholder="120" />
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary">Tạo phim</button>
            <button type="reset" class="btn btn-outline-secondary">Làm mới</button>
          </div>
        </form>
      </div>
    </section>

    <section class="card shadow-sm">
      <div class="card-body">
        <div class="mb-3">
          <label for="searchMovie" class="form-label">Tìm kiếm</label>
          <div class="input-group">
            <input id="searchMovie" type="text" class="form-control" placeholder="Tìm theo tên phim..." />
            <button type="button" class="btn btn-primary">Search</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Tên phim</th>
                <th>Thể loại</th>
                <th>Năm</th>
                <th>Thời lượng</th>
                <th>Hành động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>The Silent Code</td>
                <td>Hành động</td>
                <td>2026</td>
                <td>122 phút</td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning">Sửa</button>
                  <button type="button" class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Midnight River</td>
                <td>Kinh dị</td>
                <td>2025</td>
                <td>98 phút</td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning">Sửa</button>
                  <button type="button" class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Sunset in Da Lat</td>
                <td>Tình cảm</td>
                <td>2024</td>
                <td>110 phút</td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning">Sửa</button>
                  <button type="button" class="btn btn-sm btn-danger">Xóa</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\lab2-30-1-26\PHP2\app\views/movies/index.blade.php ENDPATH**/ ?>