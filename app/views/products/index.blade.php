@extends('layouts.index_admin')
@section('title', 'Quản lý sản phẩm')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách sản phẩm</h5>
                <a href="/product/add" class="btn btn-primary btn-sm">
                    <i class="feather-plus me-1"></i> Thêm sản phẩm
                </a>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col" style="min-width: 200px;">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col" style="max-width: 300px;">Mô tả</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td class="text-center">{{ $item['id'] }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-image avatar-md me-3">
                                            <img src="https://picsum.photos/50/50?random={{ $item['id'] }}" alt="" class="img-fluid" style="border-radius: 5px;">
                                        </div>
                                        <span class="fw-bold text-dark">{{ $item['name'] }}</span>
                                    </div>
                                </td>
                                <td class="fw-semibold text-danger">{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                                <td class="text-muted text-truncate" style="max-width: 300px;">
                                    {{ substr($item['mota'], 0, 80) . (strlen($item['mota']) > 80 ? '...' : '') }}
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ date('d/m/Y', strtotime($item['created_at'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="/product/edit/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/product/delete/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn có muốn xoá sản phẩm này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(empty($products))
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="feather-package fs-1 display-6 d-block mb-2"></i>
                                    Chưa có sản phẩm nào
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection