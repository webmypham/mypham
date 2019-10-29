{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý nhập/xuất')

@section('content_header')
    <h1> Quản lý nhập/xuất </h1>
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
                    <h3 class="box-title"> Chỉnh sửa phiếu nhập/xuất </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('receipts.update', ['receipt' => $receipt->id]) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Loại phiếu</label>
                            <select name="type" class="form-control">
                                <option value="">Chọn</option>
                                <option value="in" {{ $receipt->type == 'in' ? 'selected' : '' }}>Phiếu nhập</option>
                                <option value="out" {{ $receipt->type == 'out' ? 'selected' : '' }}>Phiếu xuất</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="product_id" class="form-control">
                                <option value="">Chọn</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $receipt->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_price">Số lượng</label>
                                <input type="text" class="form-control" name="quantity" value="{{ $receipt->quantity }}">
                            </div>
                            <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <label for="input_quantity">Tổng tiền</label>
                                <input type="number" class="form-control" name="total_amount" value="{{ $receipt->total_amount }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_description">Nhà cung cấp</label>
                            <input type="text" class="form-control" name="supplier" value="{{ $receipt->supplier }}">
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
