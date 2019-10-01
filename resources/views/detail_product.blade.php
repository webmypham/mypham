@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container">
		<div class="container j-container">
			<div class="row product-content">
				<div id="column-left" class="col-md-3 hidden-sm hidden-xs side-column">
					<div id="journal-side-category-1331324061" class="journal-side-category-113 box side-category side-category-left side-category-accordion">
						<div class="box-heading">Dưỡng Da</div>
						<div class="box-category">
							<ul>
								<li>
									<a href="https://www.kosmebox.com/tay-trang/" class="">Tẩy Trang</a>
								</li>
								<li>
									<a href="https://www.kosmebox.com/sua-rua-mat/" class="">Sữa Rửa Mặt</a>
								</li>
								<li>
									<a href="https://www.kosmebox.com/se-khit-lo-chan-long/" class="">Se Khít Lỗ Chân Lông</a>
								</li>
								<li>
									<a href="https://www.kosmebox.com/chong-nhan-chong-lao-hoa/" class="">Chống Lão Hoá</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<img src="https://cdn.shustore.com/xuanhanh_vn/1/4686/4686_4bcd265d55724d00b53c447ce1980a4a_240x240.png" id="zoom1" class="cloudzoom img-responsive full-width img-thumbnail" rel="zoomWidth:450,zoomHeight:450" data-cloudzoom="zoomImage: 'https://cdn.shustore.com/xuanhanh_vn/1/4686/4686_4bcd265d55724d00b53c447ce1980a4a_900x900.png'" style="user-select: none;">
						</div>
						<div class="col-xs-12 col-sm-8">
							<div class="item-details">
								<!-- heading -->
								<h1 itemprop="name">{{ $product->name }}</h1>
								<meta itemprop="url" content="/product/mat-ong-tam-dao-honeco-nano-curcumin-tot-cho-da-day-boi-bo-suc-khoe-600g.4686.html">
								<div class="rating hidden"></div>
								<!-- table -->
								<div class="well br-white">
									<div class="table">
										<table class="table">
											<tbody>
												<tr>
													<th>Nhãn hàng:</th>
													<td>
														<div itemprop="brand" itemscope="" itemtype="http://schema.org/Brand">
															<meta itemprop="name" content="HONECO">
															<meta itemprop="url" content="">
														</div>
				                                        HONECO
													</td>
												</tr>
												<tr>
													<th>Giá:</th>
													<td>
														<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
															<meta itemprop="priceCurrency" content="VND">
															<meta itemprop="price" content="315000">
															<link itemprop="availability" href="http://schema.org/OutOfStock">
														</div>
														<span>
															<s class="old-price">{{ number_format($product->price, 0) }} 
																<sup>đ</sup>
															</s>
															<strong class="theme">{{ number_format($product->price, 0) }} 
																<sup>đ</sup>
															</strong>
														</span>
													</td>
												</tr>
												<tr>
													<th>Trạng thái:</th>
													<td>
														<span class="label label-danger">Hết hàng</span>
													</td>
												</tr>
												<tr>
													<td colspan="2">
														<div class="input-group">
															<input type="number" value="1" min="1" product="1363" class="product-quantity form-control" style="width: 70px; z-index: auto;" name="quantity" id="quantity">
															<a href="#" class="btn btn-success cart-add-button" product="1363" onclick="addToCart({{ $product->id }})" variant="">
																<i class="fa fa-shopping-cart"></i>&nbsp; Thêm vào giỏ hàng
															</a>&nbsp;
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row item-details">
						<div class="col-xs-12">
							<h3>Thông tin  sản phẩm</h3>
							<div itemprop="description">
								{{ $product->description }}
							</div>
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
		function addToCart(id) {
			var quantity = $('#quantity').val();
			$.ajax({
				url: "{{ route('addToCart') }}",
				type: 'GET',
				data: {
					id: id,
					quantity: quantity
				},
				success: function(data) {
					$('#list-cart').html(data);
				}
			});
		}
	</script>
@endsection