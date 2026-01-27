@extends('layouts.index')
@section('title', 'Quản lý danh mục')
@section('content')
    <a href="/category/add" class="btn btn-sm btn-light border text-succes mb-3">Thêm danh mục</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Ngày tạo</th>
            <th>Act</th>
        </tr>
        @foreach ($category as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['created_at'] }}</td>
                <td>
                    <a href="/category/edit/{{ $item['id'] }}" class="btn btn-sm btn-light border text-primary">Sửa</a>
                    <a href="/category/delete/{{ $item['id'] }}" class="btn btn-sm btn-light border text-danger">Xoá</a>
                </td>
            </tr>
        @endforeach

    </table>

@endsection
@push('scripts')
<script>
    // alert("hello world")
</script>
@endpush