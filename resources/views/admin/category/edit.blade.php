{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

<<<<<<< HEAD
@section('title', 'Dashboard')
=======
@section('title', 'Admin | Quản lý sản phẩm')
>>>>>>> 098592d22a846aed22003c717162e2ca0f2b7549

@section('content_header')
    <h1> Quản lý danh mục </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Chỉnh sửa danh mục </h3>
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
<<<<<<< HEAD
    <script>
    </script>
@stop
=======
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace('input_detail',
            {
                filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
                filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
                filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
                filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });
        })
    </script>
@stop
>>>>>>> 098592d22a846aed22003c717162e2ca0f2b7549
