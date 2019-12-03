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
                    <h3 class="box-title"> Trả lời bình luận </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="id_product" class="form-control" readonly>
                                <option value="">Chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $comment->id_product == $product->id ? "selected" : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Người đăng</label>
                            <select name="id_user" class="form-control" readonly>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $comment->id_user == $user->id ? "selected" : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="input_detail">Nội dung</label>
                            <textarea class="form-control" name="content" placeholder="" rows="10" cols="80" readonly>{{ $comment->content }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="input_detail">Trả lời</label>
                            <textarea class="form-control" name="reply" placeholder="" rows="10" cols="80">{{ $comment->reply }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Trả lời</button>
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

    </script>
@stop
