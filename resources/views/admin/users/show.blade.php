{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý người dùng')

@section('content_header')
    <h1> Quản lý người dùng </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Chỉnh sửa thông tin </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Email</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_name">Tên</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_name">Số điện thoại</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $user->phone }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_name">Địa chỉ</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $user->address }}" readonly>
                    </div>
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}"><button type="button" class="btn btn-primary">Chỉnh sửa</button></a>
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
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
