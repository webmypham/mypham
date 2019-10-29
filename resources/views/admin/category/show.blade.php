{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1> Quản lý danh mục sản phẩm</h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Xem danh mục sản phẩm</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Tên category</label>
                        <input type="text" class="form-control" id="input_name" name="name" placeholder="tên" value="{{ $category->name }}">
                    </div>
                        <div class="form-group">
                            <label>Category cha:</label>
                            <select name="id_parent" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($categoriesParent as $each)
                                    <option value="{{ $each->id }}" {{ $category->id_parent == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                    </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
    </script>
@stop
