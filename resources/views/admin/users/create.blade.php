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
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thêm tài khoản </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('users.store') }}" method="POST">
                    <div class="box-body">
                        @if ($user->id_role == 0)
                        <div class="form-group">
                            <label for="input_name">Loại tài khoản</label>
                            <select class="form-control" name="role">
                                <option value="2">Khách hàng</option>
                                <option value="1">Quản trị viên</option>
                            </select>
                        </div>
                        @elseif ($user->id_role == 1)
                        <input type="hidden" name="role" value="2" />
                        @endif
                        <div class="form-group">
                            <label for="input_name">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="input_description">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" value="{{ old('password') }}">
                        </div>

                        <div class="form-group">
                            <label for="input_detail">Họ tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Họ tên" value="{{ old('name') }}" />
                        </div>
                        <div class="form-group">
                            <label for="input_detail">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}" />
                        </div>
                        <div class="form-group">
                            <label for="input_detail">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" placeholder="Đia chỉ" value="{{ old('address') }}" />
                        </div>
                        
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
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
