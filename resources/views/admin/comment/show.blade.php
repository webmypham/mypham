{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý tin tức')

@section('content_header')
    <h1> Quản lý bình luận </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Xem chi tiết bình luận </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Sản phẩm</label>
                        <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $comment->product->name ?? '' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Người đăng</label>
                        <input type="text" class="form-control" id="input_description" name="description" placeholder="Người đăng" value="{{ $comment->user_name ?? ''}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_detail">Nội dung</label>
                        <textarea class="form-control" id="input_detail" name="content" placeholder="" rows="10" cols="80" readonly>{{ $comment->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input_detail">Trả lời</label>
                        <textarea class="form-control"  name="reply" placeholder="" rows="10" cols="80" readonly>{{ $comment->reply }}</textarea>
                    </div>
                    <a href="{{ route('comments.edit', ['news' => $comment->id]) }}"><button type="button" class="btn btn-primary">Chỉnh sửa</button></a>
                    <a href="{{ route('comments.index') }}"><button type="button" class="btn">Quay lại</button></a>
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
        // $(function () {
        //     CKEDITOR.replace('input_detail',
        //     {
        //         filebrowserBrowseUrl : '/ckfinder/ckfinder.html',
        //         filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',
        //         filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',
        //         filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        //         filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        //         filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        //     });
        // })
    </script>
@stop
