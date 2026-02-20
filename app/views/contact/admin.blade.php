@extends('layouts.index_admin')
@section('title', 'Quản lý Liên hệ')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Danh sách liên hệ</h5>
                <!-- Contact messages are submitted by users, so no "Add" button here usually -->
            </div>
            @include('layouts.includes.alert')
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">ID</th>
                                <th scope="col">Tên người gửi</th>
                                <th scope="col">Email / SĐT</th>
                                <th scope="col">Chủ đề</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Ngày gửi</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $item)
                            <tr>
                                <td class="text-center text-muted fw-semibold">{{ $item['id'] }}</td>
                                <td class="fw-bold text-dark">{{ $item['name'] }}</td>
                                <td>
                                    <div><i class="feather-mail me-1 text-muted"></i> {{ $item['email'] }}</div>
                                    <div class="small text-muted"><i class="feather-phone me-1"></i> {{ $item['phone'] }}</div>
                                </td>
                                <td>{{ $item['subject'] }}</td>
                                <td>
                                    <span class="d-inline-block text-truncate" style="max-width: 200px;" title="{{ $item['message'] }}">
                                        {{ $item['message'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ isset($item['created_at']) ? date('d/m/Y H:i', strtotime($item['created_at'])) : 'N/A' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <!-- View details modal trigger could go here -->
                                        <a href="/contact/delete/{{ $item['id'] }}" class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xoá liên hệ này?');">
                                            <i class="feather-trash-2 text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if(empty($contacts))
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="feather-message-circle fs-1 display-6 d-block mb-2"></i>
                                    Chưa có liên hệ nào
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