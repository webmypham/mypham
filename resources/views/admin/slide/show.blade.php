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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Xem chi tiết slide </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Tiêu đề</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tiêu đề" value="{{ $slide->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Thứ tự</label>
                        <input type="text" class="form-control" id="input_description" name="description" placeholder="Thứ tự" value="{{ $slide->order }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="input_image">Hình ảnh</label><br />
                        @if (Storage::disk()->exists($slide->image))
                        <img src="{{ asset('storage/'.$slide->image) }}" style="width: 100%;max-width: 250px;">
                        @endif
                    </div>
                    <a href="{{ route('slides.edit', ['slide' => $slide->id]) }}"><button type="button" class="btn btn-primary">Chỉnh sửa</button></a>
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
