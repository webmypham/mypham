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
					<form action="/cart/update" id="cart_quantity" method="post">
						<input id="redirect" name="redirect" type="hidden" value="/cart">
						<div class="inner-content">
							@if (count($carts) > 0)
							<div class="inner-main cart">
								<h2>GIỎ HÀNG</h2>
                                <div class="alert alert-danger alert-block hidden" style="background-color: #da1313; color: #fff; margin-top: 20px" id="message-error">
                                    <strong id="message-error-content">Không đủ hàng</strong>
                                </div>
								<div class="table-responsive1 a-table">
									<!-- account purchase table -->
									<table class="table table-striped">
										<thead>
											<tr>
												<th>STT</th>
												<th style="width: 100px">Ảnh</th>
												<th style="max-width: 400px">Tên SP</th>
												<th>Số lượng</th>
												<th>Đơn giá</th>
												<th>Tổng</th>
											</tr>
										</thead>
										<tbody>
											@php
											$total = 0
											@endphp
												
											@foreach ($carts as $key => $item)
											@php
											$total += $item->product->price * $item->quantity
											@endphp
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>
													<a href="{{ route('product', ['slug' => str_slug(trim($item->product->name), '-'), 'id' => $item->product->id ]) }}">
														<img class="img-responsive item" src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
													</a>
												</td>
												<td style="max-width: 400px">
													<a href="{{ route('product', ['slug' => str_slug(trim($item->product->name), '-'), 'id' => $item->product->id ]) }}">{{ $item->product->name }}</a>
												</td>
												<!-- Product image -->
												<!-- Quantity with refresh and remove button -->
												<td class="item-input">
													<div class="input-group">
														<input class="form-control cart_quantity" type="number" min="0" max="{{ $item->product->quantity }}" data-id="{{ $item->product->id }}"  value="{{ $item->quantity }}" name="cart_quantity">
														<div class="input-group-btn">
															<a class="btn btn-danger" href="#" onclick="cart_remove({{ $item->product->id }}); event.preventDefault();">
																<i class="fa fa-times"></i>
															</a>
														</div>
													</div>
                                                    <label>Còn {{ $item->product->quantity }} sản phẩm</label>
												</td>
												<td>
													{{ number_format($item->product->price, 0) }} đ
												</td>
												<td>
													{{ number_format($item->product->price * $item->quantity, 0) }} đ
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
								<!-- checkout button -->
								<div class="text-right">
									<button class="btn btn-default" type="button" id="update-btn">
										<i class="fa fa-save"></i>&nbsp;Cập nhật giỏ hàng
									</button>
                                    @if (Session::get('user_logged') === true)
									    <button type="button" class="btn btn-success" id="checkout-btn">Đặt mua</button>
								    @else
                                        <button type="button" class="btn btn-success" id="show-modal-btn" data-target="#popUpWindow">Đặt mua</button>
                                    @endif
                                </div>
								<br>
							</div>
							@else
							<h3>Giỏ hàng trống</h3>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
        <div class="container">
        <div class="modal fade" id="myModal" role="dialog" style="background-color: #333; opacity: 0.9; padding-top: 100px">
            <div class="modal-dialog ">

                <!-- Modal content-->
                <div class="modal-conten col-md-6 col-md-offset-3">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 style="color:red;">Bạn phải đăng ký hoặc đăng nhập để thực hiện đặt hàng</h4>
                    </div>

                    <div class="modal-footer" style="text-align: center">
                        <a href="{{ route('user.register') }}" class="btn btn-default btn-warning"><span class="glyphicon glyphicon-lock"></span> Đăng ký</a>
                        <a href="{{ route('user.login') }}" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-log-in"></span> Đăng nhập</a>
                    </div>
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
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            })

            $("#show-modal-btn").click(function(){
                $("#myModal").modal();
            });

            function updateCart(isCheckout = false) {
                var error = false;
                var cart = [];
                $('.cart_quantity').map(function () {
                    var product = $(this);
                    cart.push({
                        id: product.attr('data-id'),
                        quantity: product.val()
                    });
                    console.log(parseInt(product.val()), product.attr('max'))
                    if (parseInt(product.val()) > parseInt(product.attr('max'))) {
                        error = true;
                    }
                });

                if (error == true) {
                    $('#message-error').removeClass('hidden');
                } else {
                    $('#message-error').addClass('hidden');
                    console.log(cart);
                    $.ajax({
                        url: "{{ route('updateCart') }}",
                        type: 'GET',
                        data: {
                            cart,
                        },
                        success: function(data) {
                            if (isCheckout == true) {
                                window.location.href = '{{ route('checkout') }}';
                            } else {
                                window.location.reload();
                            }

                        }
                    });
                }
            }

            $('#checkout-btn').on('click', function() {
                updateCart(true);
            });

            $('#update-btn').on('click', function() {
                updateCart();
            });
        });
    </script>
@endsection
