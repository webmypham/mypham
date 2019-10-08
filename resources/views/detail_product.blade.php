@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container">
		<div class="container j-container">
			<div class="row product-content">
				<div id="column-left" class="col-md-2 hidden-sm hidden-xs side-column">
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
				<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<img src="{{ url('storage/'. $product->image) }}" height="200px" id="zoom1" class="cloudzoom img-responsive full-width img-thumbnail" rel="zoomWidth:450,zoomHeight:450" data-cloudzoom="zoomImage: style="user-select: none;">
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
				</div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="sticky-scroll-box">
                        <div id="text-15" class="sidebar-widget widget_text">
                            <div class="textwidget">
                                <ul class="benifit-icon">
                                    <li class="icon_list_item">
                                        <img class="lazy list-img-icon lazy-loaded" src="{{ asset('images/icon-nuty.png') }}">
                                        <div class="icon_description_text">
                                            <p class="sun-gtmh-title"><strong>HÀNG CHÍNH HÃNG 100%</strong></p>
                                            <p class="sun-gtmh-desc">Tất cả mặt hàng đều có bill order từ nước ngoài</p>
                                        </div>
                                    </li>
                                    <li class="icon_list_item">
                                        <img class="lazy list-img-icon lazy-loaded" src="{{ asset('images/icon-gift.png') }}">
                                        <div class="icon_description_text">
                                            <p class="sun-gtmh-title"><strong>TÍCH ĐIỂM ĐẾN 10% KHI MUA TẠI CỬA HÀNG</strong></p>
                                            <p class="sun-gtmh-desc">Và tặng quà khi mua online </p>
                                        </div>
                                    </li>
                                    <li class="icon_list_item">
                                        <img class="lazy list-img-icon lazy-loaded" src="{{ asset('images/icon-ship.png') }}">
                                        <div class="icon_description_text">
                                            <p class="sun-gtmh-title"><strong> GIAO HÀNG TOÀN QUỐC</strong></p>
                                            <p class="sun-gtmh-desc">Và hỗ trợ phí ship rẻ nhất cho các quận, tỉnh còn lại.</p>
                                        </div>
                                    </li>
                                    <li class="icon_list_item">
                                        <img class="lazy list-img-icon lazy-loaded" src="{{ asset('images/icon-home.png') }}">
                                        <div class="icon_description_text">
                                            <p class="sun-gtmh-title" style="margin-top: 15px;"><strong>HỆ THỐNG CỬA HÀNG THUẬN TIỆN MUA SẮM</strong></p>

                                        </div>
                                    </li>
                                </ul>
                                <p style="color: #3c2665;font-size: 12px;text-align: center;padding: 10px 0 10px 0px;border-top: 1px solid #DDD;margin: 0;">ĐẠI LÝ PHÂN PHỐI CHÍNH THỨC 100 THƯƠNG HIỆU UY TÍN TRÊN THẾ GIỚI</p>
                            </div>
                        </div>

                    </div>
                </div>
			</div>
            <div class="row">
                <div class="product-tabs-wrapper col-sm-12 hidden-xs mt-20 mb-20 pl-0">
                        <ul  class="nav nav-pills">
                            <li class="active">
                                <a  class="plr-15" href="#description" data-toggle="tab">Chi tiết</a>
                            </li>
                            <li ><a class="plr-15" href="#product-info" data-toggle="tab">Thông tin sản phẩm</a>
                            </li>
                            <li ><a class="plr-15" href="#comment" data-toggle="tab">Đánh giá</a>
                            </li>
                        </ul>

                        <div class="tab-content clearfix">
                            <div class="tab-pane active" id="description">
                                <div class="basel-tab-wrapper">
                                    <div class="mt-20">
                                        {!! $product->detail !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="product-info">
                                <div class="basel-tab-wrapper">
                                    <div class="mt-20">
                                        <table class="table table-striped table-hover">
                                            <tbody>
                                            <tr>
                                                <td>Mã: </td>
                                                <td> <span class="sku">{{ $product->sku }}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Tên</span></td>
                                                <td>{{ $product->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Danh mục:</span></td>
                                                <td><a rel="tag">{{ $product->category->name ?? '' }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Mô tả:</span></td>
                                                <td><a rel="tag">{{ $product->description }}</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pl-10" id="comment">
                                <div id="reviews" class="woocommerce-Reviews">
                                    <div id="comments" class="mt-20 ">
                                        <h2 class="woocommerce-Reviews-title">
                                            1 đánh giá cho <span>{{ $product->name }}</span></h2>

                                        <ol class="commentlist">
                                            <li class="comment byuser comment-author-phansang even thread-even depth-1" id="li-comment-7865">

                                                <div id="comment-7865" class="comment_container">

                                                    <img alt="" src="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=60&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=120&amp;d=mm&amp;r=g 2x" class="avatar avatar-60 photo" height="60" width="60">
                                                    <div class="comment-text">


                                                        <p class="meta">
                                                            <strong class="woocommerce-review__author">Mỹ Lệ </strong>
                                                            <span class="woocommerce-review__dash">–</span> <time class="woocommerce-review__published-date" datetime="2017-03-10T22:13:51+07:00">Tháng Ba 10, 2017</time>
                                                        </p>

                                                        <div class="description"><p>Tiếp tục phát huy nha shop</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li><!-- #comment-## -->
                                        </ol>

                                    </div>

                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <span id="reply-title" class="comment-reply-title">Thêm đánh giá <small>
                                                    <a rel="nofollow" id="cancel-comment-reply-link" style="display:none;">Hủy</a></small></span>
                                                <form action="https://nuty.vn/wp-comments-post.php" method="post" id="commentform" class="comment-form">
                                                    <label for="comment">Đánh giá của bạn&nbsp;<span class="required">*</span></label>
                                                    <textarea id="comment" name="comment" cols="45" rows="8" required="" class="form-control"></textarea>
                                                    <p class="comment-form-author">
                                                        <label for="author">Tên&nbsp;
                                                            <span class="required">*</span>
                                                        </label>
                                                        <input id="author" name="author" type="text" value="" size="30" required="" class="form-control">
                                                    </p>
                                                    <p class="comment-form-email">
                                                        <label for="email">Email&nbsp;<span class="required">*</span></label>
                                                        <input id="email" name="email" type="email" value="" size="30" required="" class="form-control">
                                                    </p>
                                                    <p class="form-submit">
                                                        <input name="submit" type="submit" id="submit" class="btn btn-primary" value="Gửi đi">
                                                        <input type="hidden" name="comment_post_ID" value="35242" id="comment_post_ID">
                                                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                                    </p>
                                                </form>
                                            </div><!-- #respond -->
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row mt-30">
                <div class="col-md-12">
                    <h3 class="title slider-title">Sản phẩm tương tự</h3>
                    <div id="Carousel" class="carousel slide">

                        <ol class="carousel-indicators">
                            @foreach($similarProducts as $index => $item)
                                <li data-target="#Carousel" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>

                            @endforeach
                        </ol>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            @foreach($similarProducts as $item)
                                <div class="item {{ $loop->first ? 'active' : '' }}">

                                <div class="row">
                                    @foreach($item as $productItem)
                                    <div class="col-md-2">
                                        <a href="#">
                                            <img src="{{ url('/storage') . '/' . $productItem['image'] }}" alt="Image" style="max-width:100%; height: 150px" />
                                            <p class="text-center" style="color: #000; margin-bottom: 0">{{ Str::limit($productItem['name'], 40) }}</p>
                                            <p class="text-center" style="color: #3C2665; font-weight: bold; margin-top: 0">{{ number_format($productItem['price'], 0) }} đ</p>
                                        </a>
                                    </div>
                                    @endforeach
                                </div><!--.row-->
                            </div><!--.item-->

                            @endforeach
                        </div><!--.carousel-inner-->
                        <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                        <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>
                    </div><!--.Carousel-->

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
                    $.ajax({
                        url: "{{ route('cartCount') }}",
                        success: function( response ) {
                            console.log(response);
                            $('#cart-count').text(response);
                        }
                    });
				}
			});
		}
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            })
        });
	</script>
@endsection
