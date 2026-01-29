@extends('layouts.index_admin')
@section('title', 'Quản lý danh mục')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách danh mục</h5>
                <a href="/category/add" class="btn btn-primary btn-sm">
                    <i class="feather-plus me-1"></i> Thêm danh mục
                </a>
            </div>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                            <tr>
                                <td class="text-center">{{ $item['id'] }}</td>
                                <td class="fw-bold text-dark">{{ $item['name'] }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ date('d/m/Y', strtotime($item['created_at'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="/category/edit/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="/category/delete/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(empty($category))
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="feather-inbox fs-1 display-6 d-block mb-2"></i>
                                    Chưa có danh mục nào
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
@push('scripts')
<script>
    // alert("hello world")
</script>
@endpush