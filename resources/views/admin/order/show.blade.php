{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Admin | Quản lý đơn hàng')

@section('content_header')
    <h1> Quản lý đơn hàng </h1>
@stop

@section('content')
    <section class="content">
        <div class="row">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Chi tiết đơn hàng </h3>
                    <div class="pull-right">
                        <a href="{{ route('printBill', ['id' => $order->id]) }}" class="btn-submit btn btn-primary" style="margin-left: 10px">In hóa đơn</a>
                    </div>
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
                                        <option value="{{ $key }}" {{ $key == $order->status ? 'selected' : '' }} {{ $disable[$key] == true ? 'disabled' : '' }}>{{ $value }}</option>
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
                                                    <th align="right" style="text-align: right !important;">Số lượng</th>
                                                    <th align="right" style="text-align: right !important;">Giá</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_details as $key => $value)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                @if (Storage::disk()->exists($value->product_image))
                                                                    <img class="img-circle avatar" src="{{ asset('storage/'.$value->product_image) }}" width="50px;">
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->product_name }}</td>
                                                            <td align="right">{{ $value->quantity }}</td>
                                                            <td align="right">{{ $value->price }} VNĐ</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">											<tr>
                                                    <td align="right" colspan="4" style="padding:5px 9px">Tạm tính</td>
                                                    <td align="right" style="padding:5px 9px"><span>{{ number_format($order->total, 0) }}đ</span></td>
                                                </tr>
                                                <tr>
                                                    <td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
                                                    <td align="right" style="padding:5px 9px"><span>{{ $order->delivery_cost == 0 ? 'Miễn phí' : (number_format($order->delivery_cost, 0) . 'đ') }}</span></td>
                                                </tr>
                                                <tr bgcolor="#eee">
                                                    <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
                                                    <td align="right" style="padding:7px 9px"><strong><big><span>{{ number_format($order->amount, 0) }}đ</span> </big> </strong></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div style="padding: 10">
                            <h4><b>Thông tin nhận hàng</b></h4>
                            <p>	<i>Người nhận:</i> {{ $order->user_name }} </p>
                            <p>	<i>Địa chỉ:</i> {{ $order->user_address }} </p>
                            <p>	<i>Số điện thoại:</i> {{ $order->user_phone }} </p>
                            <p>	<i>Email:</i> {{ $order->user_email }}</p>
                            <p>	<i>Hình thức thanh toán:</i> {{ $order->payment }} </p>
                            <p>	<i>Ghi chú:</i> {{ $order->note }}</p>
                            
                            </div>
                        </div> 
                        <div class="box-footer">
                            <div class="col-md-6">
                                @if($order->status !== '1' && $order->status !== '11')
                                    <button type="submit" class="btn-submit btn btn-primary">Lưu thay đổi</button>
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
