{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý sản phẩm')

@section('content_header')
    <h1> Quản lý sản phẩm </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Chi tiết đơn hàng </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <form method="POST" action="{{ route('orders.update', ['order'=> $order->id]) }}" enctype="multipart/form-data" id="updateOrder">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Customer: </label>
                                <input type="text" class="form-control" disabled="" value="{{ $order->customer_name }}">
                            </div>
        
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control mdb-select md-form" name="status">
                                    @foreach ($order_status as $key => $value )
                                        <option value="{{ $key }}" {{ $key == $order->status ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <br>
                            <h3 class="text-bold text-center">Chi tiết đơn hàng</h3>
                            <div class="container-fluid mb-4 box">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Hình ảnh</th>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Giá</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_details as $key => $value)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                @if (file_exists($value->product_image))
                                                                <img src="{{ $value->product_image }}" style="width: 95px; height: 63px;">
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->product_name }}</td>
                                                            <td>{{ $value->quantity }}</td>
                                                            <td>{{ $value->price }} VNĐ</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <h3>Tổng: {{ $order->amount }} VNĐ</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-3 col-md-offset-3">
                                @if($order->status !== '1' && $order->status !== '11')
                                    <button type="submit" class="btn-submit btn btn-primary col-md-12">Update</button>
                                @endif
                            </div>
        
                            <div class="col-md-3">
                                <a href="{{ route('orders.index') }}"><button type="button" class="btn btn-block btn-light col-md-12" style="color: white">Back</button></a>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div>
        </div>
    </section>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
    </script>
@stop
