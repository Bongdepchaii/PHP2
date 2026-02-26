@extends('layouts.index_admin')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card stretch stretch-full">

            {{-- Card Header --}}
            <div class="card-header d-flex flex-wrap align-items-center gap-2">
                <h5 class="card-title me-auto mb-0">
                    Danh sách liên hệ
                    <span class="badge bg-soft-secondary text-secondary ms-2">{{ $total }}</span>
                </h5>
                {{-- Search --}}
                <form method="GET" action="/contact/admin" class="d-flex align-items-center">
                    <div class="input-group input-group-sm" style="width:260px;">
                        <input type="text" class="form-control" name="q"
                               placeholder="Tìm tên, email, chủ đề..."
                               value="{{ $keyword }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="feather-search"></i>
                        </button>
                        @if($keyword)
                        <a href="/contact/admin" class="btn btn-outline-danger" title="Xóa tìm kiếm">
                            <i class="feather-x"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            @include('layouts.includes.notification')

            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width:50px;">ID</th>
                                <th>Người gửi</th>
                                <th>Email / SĐT</th>
                                <th>Chủ đề</th>
                                <th>Nội dung</th>
                                <th>Ngày gửi</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contacts as $item)
                            <tr>
                                <td class="text-center text-muted fw-semibold">#{{ $item['id'] }}</td>
                                <td class="fw-semibold">{{ $item['full_name'] }}</td>
                                <td>
                                    <div><i class="feather-mail me-1 text-muted"></i>{{ $item['email'] }}</div>
                                    <div class="small text-muted"><i class="feather-phone me-1"></i>{{ $item['phone'] }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary">{{ $item['subject'] }}</span>
                                </td>
                                <td style="max-width:220px;">
                                    <span class="d-inline-block text-truncate w-100" title="{{ $item['message'] }}">
                                        {{ $item['message'] }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ date('d/m/Y H:i', strtotime($item['created_at'])) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="/contact/delete/{{ $item['id'] }}?q={{ urlencode($keyword) }}&from_page={{ $page }}"
                                       class="avatar-text avatar-md text-danger"
                                       title="Xóa liên hệ"
                                       onclick="return confirm('Xóa liên hệ #{{ $item['id'] }} của {{ $item['full_name'] }}?');">
                                        <i class="feather-trash-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="feather-message-circle fs-1 display-6 d-block mb-2"></i>
                                    @if($keyword)
                                        Không tìm thấy liên hệ nào cho &ldquo;<strong>{{ $keyword }}</strong>&rdquo;
                                    @else
                                        Chưa có liên hệ nào
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            @if($totalPage > 1 || $total > 0)
            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2 py-2">
                <small class="text-muted">
                    Hiển <strong>{{ min(($page-1)*$perPage+1, $total) }}&ndash;{{ min($page*$perPage, $total) }}</strong>
                    trong tổng <strong>{{ $total }}</strong> liên hệ
                    @if($keyword)<span class="ms-1">cho &ldquo;<strong>{{ $keyword }}</strong>&rdquo;</span>@endif
                </small>
                @if($totalPage > 1)
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="/contact/admin?page={{ $page-1 }}&q={{ urlencode($keyword) }}">
                                <i class="feather-chevron-left"></i>
                            </a>
                        </li>
                        @for($p = max(1, $page-2); $p <= min($totalPage, $page+2); $p++)
                        <li class="page-item {{ $p === $page ? 'active' : '' }}">
                            <a class="page-link" href="/contact/admin?page={{ $p }}&q={{ urlencode($keyword) }}">{{ $p }}</a>
                        </li>
                        @endfor
                        <li class="page-item {{ $page >= $totalPage ? 'disabled' : '' }}">
                            <a class="page-link" href="/contact/admin?page={{ $page+1 }}&q={{ urlencode($keyword) }}">
                                <i class="feather-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
@endsection