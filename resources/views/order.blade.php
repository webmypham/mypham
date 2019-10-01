@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
    <div class="extended-container">
        <div class="container j-container">
            <div class="row product-content inner-content">
                <div class="col-sm-3 hidden-xs">
                    @include('left_nav')
                </div>
                <div class="col-sm-9 col-xs-12">
                    <!-- top heading -->
                    <h2>Chi tiết đơn hàng</h2>
                    <!-- heading -->
                    <div class="table-responsive a-table">
                        <!-- account purchase table -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th style="min-width: 100px;">Tổng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_details as $item)
                                <tr>
                                    <!-- Index -->
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- Product  name -->
                                    <td><a href="{{ route('product', ['slug' => str_slug(trim($item->product_name), '-'), 'id' => $item->id_product ]) }}">{{ $item->product_name }}</a></td>
                                    <!-- Product image -->
                                    <td>
                                        <a href="{{ route('product', ['slug' => str_slug(trim($item->product_name), '-'), 'id' => $item->id_product ]) }}">
                                            <img class="img-responsive item" src="{{ asset('storage/'.$item->product_image) }}" alt="{{ $item->product_name }}" style="max-height: 80px;"></a>
                                    </td>
                                    <!-- Quantity with refresh and remove button -->
                                    <td>{{ $item->quantity }}</td>
                                    <!-- Unit price -->
                                    <td>{{ number_format($item->price, 0) }} <sup>đ</sup></td>
                                    <!-- Total cost -->
                                    <td>{{ number_format($item->price * $item->quantity, 0) }} <sup>đ</sup></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th></th>
                                    <th colspan="4">Giá trị đơn hàng</th>
                                    <th>{{ number_format($order->amount, 0) }} <sup>đ</sup></th>
                                </tr>

                                {{-- <tr>
                                    <th></th>
                                    <th colspan="4">Chuyển phát nhanh</th>
                                    <th> <sup>đ</sup></th>
                                </tr>

                                <tr>
                                    <th></th>
                                    <th colspan="4">Chuyển khoản qua ngân hàng</th>
                                    <th>0 <sup>đ</sup></th>
                                </tr>

                                <tr>

                                    <th></th>
                                    <th colspan="4">Tổng</th>
                                    <th>318,000 <sup>đ</sup></th>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>

                    <form class="form-horizontal" id="payment-update-form">
                        <h2>Thanh toán</h2>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Trạng thái</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled="" value="{{ $order->status_text }}">
                            </div>
                        </div>
                        <div id="payment-info-notes"></div>
                    </form>

                    <form class="form-horizontal">
                        <!-- heading -->
                        {{-- <h2>Người nhận</h2> --}}
                        <div class="form-group">
                            <label for="full_name" class="col-sm-3 control-label">Họ tên</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" disabled="" value="Test">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="email" disabled="" value="tranvanthanhx11@gmail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Điện thoại</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="phone" name="phone" disabled="" placeholder="Điện thoại" value="09856169450">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street" class="col-sm-3 control-label">Địa chỉ</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="street" name="street" rows="3" disabled="" placeholder="Địa chỉ">北四条西（２０～３０丁目）</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province" class="col-sm-3 control-label">Tỉnh thành</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="province" name="phone" disabled="" placeholder="Điện thoại" value="Hồ Chí Minh">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ghi chú</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="Comment" name="Comment" disabled="" rows="3"></textarea>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection