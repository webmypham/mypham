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
							@if (Session::get('cart'))
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
												<th>#</th>
												<th style="width: 100px">Tên</th>
												<th></th>
												<th></th>
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
												<td>
													<a href="{{ route('product', ['slug' => str_slug(trim($item['product']->name), '-'), 'id' => $item['product']->id ]) }}">{{ $item['product']->name }}</a>
												</td>
												<!-- Product image -->
												<!-- Quantity with refresh and remove button -->
												<td class="item-input">
													<div class="input-group">
														<input class="form-control cart_quantity" type="number" min="0" max="{{ $item['product']->quantity }}" data-id="{{ $item['product']->id }}"  value="{{ $item['quantity'] }}" name="cart_quantity">
														<div class="input-group-btn">
															<a class="btn btn-danger" href="#" onclick="cart_remove({{ $item['product']->id }}); event.preventDefault();">
																<i class="fa fa-times"></i>
															</a>
														</div>
													</div>
                                                    <label>Còn {{ $item['product']->quantity }} sản phẩm</label>
												</td>
												<td>
													{{ number_format($item['product']->price, 0) }}<sup>đ</sup>
												</td>
												<td>
													{{ number_format($item['product']->price * $item['quantity'], 0) }} <sup>đ</sup>
												</td>
											</tr>
											@endforeach
											
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th>Tổng</th>
												<th>{{ number_format($total, 0) }}</th>
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
									<a href="javascript:void(0)" class="btn btn-success" id="checkout-btn">Đặt mua</a>
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

            function updateCart(isCheckout = false) {
                var error = false;
                var cart = [];
                $('.cart_quantity').map(function () {
                    var product = $(this);
                    cart.push({
                        id: product.attr('data-id'),
                        quantity: product.val()
                    });
                    if (product.val() > product.attr('max')) {
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
