@extends('layouts.index_admin')
@section('title', 'Quản lý thương hiệu')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách thương hiệu</h5>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
                    <i class="feather-plus me-1"></i> Thêm thương hiệu
                </a>
            </div>
              @include('layouts.includes.notification')
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên thương hiệu</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trademark as $item)
                            <tr>
                                <td class="text-center text-muted fw-semibold">{{ $item['id'] }}</td>
                                <td class="fw-bold text-dark">{{ $item['name'] }}</td>
                                <td>
                                    <div class="avatar-image avatar-lg">
                                        <img src="/app/images/img/{{ $item['img'] }}" alt="{{ $item['name'] }}" class="img-fluid rounded border p-1 bg-white" style="object-fit: contain;">
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ date('d/m/Y', strtotime($item['created_at'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                       <a href="javascript:void(0);" 
                                           class="avatar-text avatar-md" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#modalEdit"
                                           data-id="{{ $item['id'] }}"
                                           data-name="{{ $item['name'] }}"
                                           title="Chỉnh sửa">
                                            <i class="feather-edit text-primary"></i>
                                        </a>
                                        <a href="trademark/delete/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xoá thương hiệu này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(empty($trademark))
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="feather-award fs-1 display-6 d-block mb-2"></i>
                                    Chưa có thương hiệu nào
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

@push('modals')
<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/trademark/add" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Thêm thương hiệu mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameAdd" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="nameAdd" name="name" required placeholder="Nhập tên thương hiệu">
                    </div>
                    <div class="mb-3">
                        <label for="nameAdd" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="img" required >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Cập nhật thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameEdit" class="form-label">Tên thương hiệu</label>
                        <input type="text" class="form-control" id="nameEdit" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="imgEdit" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="imgEdit" name="img">
                        <small class="text-muted">Để trống nếu không thay đổi ảnh</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endpush

@endsection
@push('scripts')
<script>
    const modalEdit = document.getElementById('modalEdit');
    modalEdit.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        
        // Update the modal's content.
        const modalTitle = modalEdit.querySelector('.modal-title');
        const inputName = modalEdit.querySelector('#nameEdit');
        const formEdit = modalEdit.querySelector('#formEdit');

        inputName.value = name;
        formEdit.action = `/trademark/update/${id}`;
    });
</script>
@endpush