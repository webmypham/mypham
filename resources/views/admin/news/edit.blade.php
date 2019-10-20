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
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Xem chi tiết tin tức </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('news.update', ['news' => $news->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_name">Tiêu đề</label>
                            <input type="text" class="form-control" id="input_name" name="title" placeholder="Tên sản phẩm" value="{{ $news->title }}" >
                        </div>
                        <div class="form-group">
                            <label for="input_description">Mô tả</label>
                            <input type="text" class="form-control" id="input_description" name="description" placeholder="Mô tả" value="{{ $news->description }}" >
                        </div>
                        <div class="form-group">
                            <label for="input_detail">Nội dung</label>
                            <textarea class="form-control" id="input_detail" name="content" placeholder="" rows="10" cols="80" >{{ $news->content }}</textarea>
                        </div>
                        <div class="form-group">
                                <label for="input_image">Hình ảnh</label>
                                <input type="file" id="input_image" name="thumbnail">
                            </div>
                        <div class="form-group">
                            <label for="input_image">Hình ảnh cũ</label><br />
                            @if (Storage::disk()->exists($news->thumbnail))
                            <img src="{{ asset('storage/'.$news->thumbnail) }}" style="width: 100%;max-width: 250px;">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ url()->previous() }}"><button type="button" class="btn">Quay lại</button></a>
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
