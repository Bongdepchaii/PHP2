@extends('layouts.index_admin')
@section('title', $title)
@section('content')
    <form action="/category/add" method="post">
        <label for="">Danh mucj</label>
        <input name="name" type="text">
        <button type="submit" class="btn">Thêm danh mục</button>
    </form>
@endsection