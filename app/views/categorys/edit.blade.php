@extends('layouts.indexindex_admin')
@section('title', $title)
@section('content')
    <form action="/category/update/{{$category['id']}}" method="POST">
        <label for="">Danh mục</label>
        <input name="name" value="{{ $category['name'] }}" type="text">
        <button type="submit" class="btn">Sửa</button>
    </form>
@endsection