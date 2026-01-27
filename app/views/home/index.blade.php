@extends('layouts.index')
@section('title', 'danh mục')
@section('content')
    <a href="/category/add" class="btn btn-sm btn-light border text-succes">Them danh muc</a>
    <table class="table">
        <tr>
            <th> id </th>
            <th> name </th>
            <th> image </th>
            <th>action</th>
        </tr>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td><img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"></td>
                <td>
                    <a href="/danhmuc/delete/{{ $item['id'] }}" class="btn btn-sm btn-light border text-danger">Delete
                    </a>
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