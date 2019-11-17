@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container">
		<div class="container j-container">
			<div class="row product-content">
				<div class="col-sm-3 hidden-xs">
					@include('left_nav')
				</div>
				<div class="col-sm-9 col-xs-12">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block" style="background-color: #da1313; color: #fff; margin-top: 20px">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    {{-- <h1>Xác nhận đặt hàng</h1> --}}
						<div class="inner-main account cart">
							@if (Session::get('cart'))
							<div class="inner-main cart">
								<h2>Sản phẩm</h2>
								<div class="table-responsive1 a-table">
									<!-- account purchase table -->
									<table class="table table-striped">
										<thead>
											<tr>
												<th>STT</th>
												<th style="width: 100px">Ảnh</th>
												<th style="max-width: 400px">Tên sản phẩm</th>
												<th>Số lượng</th>
												<th>Đơn giá</th>
												<th>Tổng</th>
											</tr>
										</thead>
										<tbody>
											@php
											$total = 0
											@endphp
												
											@foreach (Session::get('cart') as $key => $item)
											@php
											$total += $item['product']->price * $item['quantity']
											@endphp
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>
													<a href="{{ route('product', ['slug' => str_slug(trim($item['product']->name), '-'), 'id' => $item['product']->id ]) }}">
														<img class="img-responsive item" src="{{ asset('storage/'.$item['product']->image) }}" alt="{{ $item['product']->name }}">
													</a>
												</td>
												<td style="max-width: 400px">
													<a href="{{ route('product', ['slug' => str_slug(trim($item['product']->name), '-'), 'id' => $item['product']->id ]) }}">{{ $item['product']->name }}</a>
												</td>
												<!-- Product image -->
												<!-- Quantity with refresh and remove button -->
												<td class="item-input">
													<div class="input-group">
														<input class="form-control" type="number" min="0" max="2147483647" value="{{ $item['quantity'] }}" readonly>
														<div class="input-group-btn">
															<a class="btn btn-danger" href="#" onclick="cart_remove({{ $item['product']->id }}); event.preventDefault();">
																<i class="fa fa-times"></i>
															</a>
														</div>
													</div>
												</td>
												<td>
													{{ number_format($item['product']->price, 0) }} đ
												</td>
												<td>
													{{ number_format($item['product']->price * $item['quantity'], 0) }} đ
												</td>
											</tr>
											@endforeach
											
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th style="color: red">Tổng</th>
												<th style="color: red">{{ number_format($total, 0) }} đ</th>
											</tr>
										</tbody>
									</table>
								</div>
                                <!-- heading / Discount Coupon -->
                                <form class="form-horizontal" action="{{ route('save_order') }}" id="cart_quantity" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <h2>Thông tin người nhận</h2>
                                    <div id="receiver-pane">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="email" value="{{ $user->email ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="full_name" class="col-sm-3 control-label">Họ tên</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" name="full_name" id="full_name" placeholder="Họ tên" value="{{ $user->name ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="col-sm-3 control-label">Điện thoại</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại" value="{{ $user->phone ?? ''}}">
                                            </div>
                                            <div class="col-sm-5">Viết liền, không chấm, không gạch ngang</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class="col-sm-3 control-label">Địa chỉ</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="street" name="street" rows="3" placeholder="Địa chỉ">{{ $user->address ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="province" class="col-sm-3 control-label">Tỉnh thành</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="province" name="province">
                                                    <option value="57">An Giang</option>
                                                    <option value="44">Bà Rịa-Vũng Tàu</option>
                                                    <option value="15">Bắc Cạn</option>
                                                    <option value="9">Bắc Giang</option>
                                                    <option value="60">Bạc Liêu</option>
                                                    <option value="10">Bắc Ninh</option>
                                                    <option value="56">Bến Tre</option>
                                                    <option value="36">Bình Định</option>
                                                    <option value="45">Bình Dương</option>
                                                    <option value="46">Bình Phước</option>
                                                    <option value="42">Bình Thuận</option>
                                                    <option value="59">Cà Mau</option>
                                                    <option value="51">Cần Thơ</option>
                                                    <option value="12">Cao Bằng</option>
                                                    <option value="31">Đà Nẵng</option>
                                                    <option value="28">Đắk Lắk</option>
                                                    <option value="29">Đắk Nông</option>
                                                    <option value="7">Điện Biên</option>
                                                    <option value="41">Đồng Nai</option>
                                                    <option value="48">Đồng Tháp</option>
                                                    <option value="39">Gia Lai</option>
                                                    <option value="5">Hà Giang</option>
                                                    <option value="23">Hà Nam</option>
                                                    <option value="62">Hà Nội</option>
                                                    <option value="27">Hà Tĩnh</option>
                                                    <option value="19">Hải Dương</option>
                                                    <option value="18">Hải Phòng</option>
                                                    <option value="52">Hậu Giang</option>
                                                    <option selected="selected" value="63">Hồ Chí Minh</option>
                                                    <option value="4">Hòa Bình</option>
                                                    <option value="20">Hưng Yên</option>
                                                    <option value="38">Khánh Hoà</option>
                                                    <option value="58">Kiên Giang</option>
                                                    <option value="40">Kon Tum</option>
                                                    <option value="8">Lai Châu</option>
                                                    <option value="43">Lâm Đồng</option>
                                                    <option value="11">Lạng Sơn</option>
                                                    <option value="1">Lào Cai</option>
                                                    <option value="53">Long An</option>
                                                    <option value="22">Nam Định</option>
                                                    <option value="26">Nghệ An</option>
                                                    <option value="17">Ninh Bình</option>
                                                    <option value="49">Ninh Thuận</option>
                                                    <option value="2">Phú Thọ</option>
                                                    <option value="37">Phú Yên</option>
                                                    <option value="32">Quảng Bình</option>
                                                    <option value="30">Quảng Nam</option>
                                                    <option value="35">Quảng Ngãi</option>
                                                    <option value="21">Quảng Ninh</option>
                                                    <option value="33">Quảng Trị</option>
                                                    <option value="61">Sóc Trăng</option>
                                                    <option value="6">Sơn La</option>
                                                    <option value="47">Tây Ninh</option>
                                                    <option value="24">Thái Bình</option>
                                                    <option value="14">Thái Nguyên</option>
                                                    <option value="25">Thanh Hoá</option>
                                                    <option value="34">Thừa Thiên-Huế</option>
                                                    <option value="54">Tiền Giang</option>
                                                    <option value="55">Trà Vinh</option>
                                                    <option value="13">Tuyên Quang</option>
                                                    <option value="50">Vĩnh Long</option>
                                                    <option value="3">Vĩnh Phúc</option>
                                                    <option value="16">Yên Bái</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- <h2>Chọn cách thức giao hàng và thanh toán</h2> --}}
                                    <div id="shipping-pane">
                                        <!-- heading -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phương thức giao hàng</label>
                                            <div class="col-sm-8">
                                                <select id="shipping_methods" class="form-control">
                                                    <option value="express">Chuyển phát nhanh (20000 đ)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="payment-pane">
                                        <!-- heading -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Phương thức thanh toán</label>
                                            <div class="col-sm-8">
                                                <select id="payment_methods" class="form-control" name="id_payment">
                                                    <option value="1">Nhận tiền khi giao hàng (miễn phí)</option>
                                                    <option value="2" selected="">Chuyển khoản qua ngân hàng (miễn phí)</option>
                                                    <option value="3">Thanh toán qua VTC Pay (pay.vtc.vn) (miễn phí)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- <h2>Tùy chọn</h2> --}}
                                    <div id="note-pane">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Ghi chú</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="Comment" name="note" rows="3" placeholder="Nội dung ghi chú giúp chúng tôi xử lý đơn hàng chính xác hơn"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cart">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" class="btn btn-success" id="checkout_button">Xác nhận đặt hàng <i class="fa fa-arrow-circle-o-right"></i></button>
                                            &nbsp;
                                        </div>
                                    </div>
					            </form>
							</div>
							@else
							<h2>Giỏ hàng trống</h2>
							@endif
						</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('script')
    <script>
        function cart_remove(id) {
            var quantity = parseInt($('#quantity').val());
            console.log(quantity);
            $.ajax({
                url: "{{ route('removeFromCart') }}",
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(data) {
                    window.location.reload();
                }
            });


        }
    </script>
 @endsection
