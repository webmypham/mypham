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
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thêm bình luận </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="id_product" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="id_user" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input_detail">Nội dung</label>
                            <textarea class="form-control" name="content" placeholder="" rows="10" cols="80">{{ old('content') }}</textarea>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Thêm bình luận</button>
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
    {{--<script src="/ckeditor/ckeditor.js"></script>--}}
    {{--<script>--}}
        {{--$(function () {--}}
            {{--CKEDITOR.replace('content',--}}
            {{--{--}}
                {{--filebrowserBrowseUrl : '/ckfinder/ckfinder.html',--}}
                {{--filebrowserImageBrowseUrl : '/ckfinder/ckfinder.html?type=Images',--}}
                {{--filebrowserFlashBrowseUrl : '/ckfinder/ckfinder.html?type=Flash',--}}
                {{--filebrowserUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',--}}
                {{--filebrowserImageUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',--}}
                {{--filebrowserFlashUploadUrl : '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'--}}
            {{--});--}}
        {{--})--}}
    {{--</script>--}}
@stop
