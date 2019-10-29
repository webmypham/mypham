{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý slide')

@section('content_header')
    <h1> Quản lý slide </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thêm tin tức </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('slides.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tiêu đề</label>
                            <input type="text" class="form-control" name="name" placeholder="Tiêu đề" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="input_description">Thứ tự</label>
                            <input type="number" class="form-control" name="order" placeholder="Thứ tự" value="{{ old('order') }}">
                        </div>
                        <div class="form-group">
                            <label for="input_image">Hình ảnh</label>
                            <input type="file" id="input_image" name="image">
                        </div>
                        
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Thêm slide</button>
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
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        $(function () {
            CKEDITOR.replace('content',
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
