{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý phiếu')

@section('content_header')
    <h1> Quản lý phiếu </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Xem chi tiết phiếu </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="input_name">Loại phiếu</label>
                        <input type="text" class="form-control" id="input_name" name="name" value="{{ $receipt->type == 'in' ? 'Phiếu nhập': 'Phiếu xuất' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Người tạo</label>
                        <input type="text" class="form-control" id="input_description" name="description" value="{{ $receipt->user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_price">Sản phẩm</label>
                        <input type="text" class="form-control" id="input_price" name="price" value="{{ $receipt->product->name }}" readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label for="input_price">Số lượng</label>
                            <input type="number" class="form-control" id="input_price" name="price" value="{{ $receipt->quantity }}" readonly>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <label for="input_quantity">Giá</label>
                            <input type="text" class="form-control" id="input_quantity" name="input_price" value="{{ number_format($receipt->product->input_price, 0) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Tổng tiền</label>
                        <input type="text" class="form-control" id="input_description" name="description" value="{{ number_format($receipt->total_amount, 0) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Nhà cung cấp</label>
                        <input type="text" class="form-control" id="input_description" name="description" value="{{ $receipt->supplier }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="input_description">Ngày tạo</label>
                        <input type="text" class="form-control" id="input_description" name="description" value="{{ date('d/m/Y: H:i', strtotime($receipt->created_at)) }}" readonly>
                    </div>
                    <a href="{{ route('receipts.edit', ['receipt' => $receipt->id]) }}"><button type="button" class="btn btn-primary">Edit</button></a>
                    <a href="{{ url()->previous() }}"><button type="button" class="btn">Back</button></a>
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
@stop
