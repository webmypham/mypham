{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý tin tức')

@section('content_header')
    <h1> Quản lý tin tức </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Xem chi tiết tin tức </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Tiêu đề</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $news->title }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Mô tả</label>
                        <input type="text" class="form-control" id="input_description" name="description" placeholder="Mô tả" value="{{ $news->description }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_detail">Chi tiết</label>
                        <textarea class="form-control" id="input_detail" name="content" placeholder="" rows="10" cols="80" readonly>{{ $news->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input_image">Hình ảnh</label><br />
                        @if (Storage::disk()->exists($news->thumbnail))
                        <img src="{{ asset('storage/'.$news->thumbnail) }}" style="width: 100%;max-width: 250px;">
                        @endif
                    </div>
                    <a href="{{ route('news.edit', ['news' => $news->id]) }}"><button type="button" class="btn btn-primary">Chỉnh sửa</button></a>
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
