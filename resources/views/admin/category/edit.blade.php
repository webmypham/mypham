@extends('adminlte::page')
@section('title', 'Admin | Quản lý danh mục sản phẩm')

@section('content_header')
    <h1> Quản lý danh mục sản phẩm</h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa danh mục sản phẩm</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="input_name" name="name" placeholder="Tên sản phẩm" value="{{ $category->name }}" >
                        </div>
                        <div class="form-group">
                            <label>Danh mục cha:</label>
                            <select name="id_parent" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($categoriesParent as $each)
                                    <option value="{{ $each->id }}"  {{ $category->id_parent == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_image">Hình ảnh</label>
                            <input type="file" id="input_image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url()->previous() }}"><button type="button" class="btn">Back</button></a>
                    </div>
                </form>
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
