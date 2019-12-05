@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container">
		<div class="container j-container">
			<div class="row product-content">

				<div class="col-md-9 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<img src="{{ url('storage/'. $product->image) }}" height="250px" id="zoom1" class="cloudzoom img-responsive full-width img-thumbnail" rel="zoomWidth:450,zoomHeight:450" data-cloudzoom="zoomImage: style="user-select: none;">
						</div>
						<div class="col-xs-12 col-sm-7">
							<div class="item-details">
								<!-- heading -->
								<h1 class="name mb-20">{{ $product->name }}</h1>
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
                                                @if($product->status == 1)
												<tr>
													<th>Giá:</th>
													<td>
														<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
															<meta itemprop="priceCurrency" content="VND">
															<meta itemprop="price" content="315000">
															<link itemprop="availability" href="http://schema.org/OutOfStock">
														</div>
														<span>
                                                            @if ($product->sale_value)
                                                                <s class="old-price">{{ number_format($product->price, 0) }}
                                                                    <sup>đ</sup>
                                                                </s>

                                                                <strong class="theme">{{ number_format($product->sale_price, 0) }}
                                                                    <sup>đ</sup>
                                                                </strong>
                                                            @else
                                                                <strong class="theme">{{ number_format($product->price, 0) }}
                                                                    <sup>đ</sup>
                                                                </strong>
                                                            @endif
														</span>
													</td>
												</tr>
												<tr>
													<th>Trạng thái:</th>
													<td>
                                                        @if($product->quantity == 0)
														    <span class="label label-danger">{{ $product->quantity == 0 ? 'Hết hàng' : '' }}</span>
                                                        @else
                                                            <span class="label label-primary">Còn {{ $product->quantity }} sản phẩm</span>
                                                        @endif
													</td>
												</tr>
                                                @endif
                                                @if($product->quantity > 0)
												<tr>
													<td colspan="2">
														<div class="input-group">
                                                            @if($product->status == 1)
															<input type="number" value="1" min="1" max="{{ $product->quantity }}" class="product-quantity form-control" style="width: 70px; z-index: auto; height: 36px" name="quantity" id="quantity">
                                                            <button class="btn btn-success cart-add-button" onclick="addToCart({{ $product->id }})" variant="">
                                                                <i class="fa fa-shopping-cart"></i>&nbsp; Thêm vào giỏ hàng
                                                            </button>
                                                            @else
                                                                <button class="btn btn-info cart-add-button">
                                                                    <i class="fa fa-shopping-cart"></i>&nbsp; Sản phẩm sắp ra mắt
                                                                </button>
                                                            @endif
														</div>
													</td>
												</tr>
                                                @elseif($product->status != 1)
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="input-group">
                                                                <button class="btn btn-info cart-add-button">
                                                                    <i class="fa fa-shopping-cart"></i>&nbsp; Sản phẩm sắp ra mắt
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr id="message-error" class="hidden">
                                                    <td colspan="2">
                                                        <div class="alert alert-danger alert-block" style="background-color: #da1313; color: #fff; margin-top: 20px">
                                                            <strong id="message-error-content">Vui lòng nhập số lượng lớn hơn 0</strong>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr id="message-success" class="hidden">
                                                    <td colspan="2">
                                                        <div class="alert alert-success alert-block" style="background-color: #5cb85c; color: #fff; margin-top: 20px">
                                                            <strong id="message-error-content">Thêm vào giỏ hàng thành công</strong>
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
                    <div class="product-tabs-wrapper col-sm-12 hidden-xs mt-30 mb-20 pl-0">
                        <ul  class="nav nav-pills">
                            <li class="active">
                                <a  class="plr-15" href="#description" data-toggle="tab">Chi tiết</a>
                            </li>
                            <li ><a class="plr-15" href="#product-info" data-toggle="tab">Thông tin sản phẩm</a>
                            </li>
                            <li ><a class="plr-15" href="#comment" data-toggle="tab">Bình luận</a>
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
                                        <table class="table table-striped table-hover table-responsive">
                                            <tbody>
                                            <tr>
                                                <td style="min-width: 100px">Mã: </td>
                                                <td> <span class="sku">{{ $product->sku }}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Tên: </span></td>
                                                <td>{{ $product->name }}</td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Danh mục: </span></td>
                                                <td><a rel="tag">{{ $product->category_name ?? '' }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><span class="posted_in">Mô tả: </span></td>
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
                                            {{ count($comments) }} bình luận cho <span>{{ $product->name }}</span></h2>

                                        <ol class="commentlist">
                                            @foreach ($comments as $comment)
                                            <li class="comment byuser comment-author-phansang even thread-even depth-1" style="margin-bottom: 0">
                                                <div id="comment-7865" class="comment_container">

                                                    <img alt="" src="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=60&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=120&amp;d=mm&amp;r=g 2x" class="avatar avatar-60 photo" height="60" width="60">
                                                    <div class="comment-text">


                                                        <p class="meta">
                                                            <strong class="woocommerce-review__author">{{ $comment->user_name ?? '' }}</strong>
                                                            <span class="woocommerce-review__dash">–</span> <time class="woocommerce-review__published-date" datetime="2017-03-10T22:13:51+07:00">{{ Carbon\Carbon::parse($comment->created_at)->format('d/m/y') }}</time>
                                                        </p>

                                                        <div class="description"><p>{!! $comment->content !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li><!-- #comment-## -->
                                            @if($comment->reply)
                                                    <li class="comment byuser comment-author-phansang even thread-even depth-1" style="margin-left: 40px; margin-top: 0">
                                                        <div id="comment-7865" class="comment_container">

                                                            <img alt="" src="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=60&amp;d=mm&amp;r=g" srcset="https://secure.gravatar.com/avatar/c94587dd5453c16fa9ea5e6280882c95?s=120&amp;d=mm&amp;r=g 2x" class="avatar avatar-60 photo" height="60" width="60">
                                                            <div class="comment-text">


                                                                <p class="meta">
                                                                    <strong class="woocommerce-review__author">Mỹ phẩm cosmetic</strong>
                                                                    <span class="woocommerce-review__dash">–</span> <time class="woocommerce-review__published-date" datetime="2017-03-10T22:13:51+07:00">{{ Carbon\Carbon::parse($comment->created_at)->format('d/m/y') }}</time>
                                                                </p>

                                                                <div class="description"><p>{!! $comment->reply !!}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li><!-- #comment-## -->
                                            @endif
                                            @endforeach
                                        </ol>

                                    </div>
                                    @if (Session::get('user_logged') === true)

                                        <div id="review_form_wrapper">
                                            <div id="review_form">
                                                <div id="respond" class="comment-respond">
                                                    <span id="reply-title" class="comment-reply-title">Thêm bình luận <small>
                                                        <a rel="nofollow" id="cancel-comment-reply-link" style="display:none;">Hủy</a></small></span>
                                                    <form action="{{ route('user.comment') }}" method="post" class="comment-form">
                                                        {!! csrf_field() !!}
                                                        <label for="comment">Bình luận của bạn&nbsp;<span class="required">*</span></label>
                                                        <textarea id="comment" name="comment" cols="45" rows="8" required="" class="form-control"></textarea>

                                                        <p class="form-submit mt-20">

                                                            <input name="submit" type="submit" id="submit" class="btn btn-primary" value="Gửi đi">
                                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                            @if (Session::get('user_logged') === true)
                                                                <input type="hidden" name="user_id" value="{{ Session::get('user_info')->id }}">
                                                                <input type="hidden" name="user_name" value="{{ Session::get('user_info')->name }}">
                                                            @endif
                                                        </p>
                                                    </form>
                                                </div><!-- #respond -->
                                            </div>
                                        </div>
                                    @else
                                        <p>Bạn cần đăng nhập để bình luận</p>
                                    @endif

                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="row">
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
                        <div class="col-md-12 hidden-sm hidden-xs side-column mt-20 left-sidebar">
                            <div class="categories">
                                <h4 class="title">Danh mục </h4>
                                <ul class="nav navbar-nav">
                                    @foreach($categories as $category)
                                        <li class="active dropdown">
                                            <a class="dropdown-toggle" href="{{ route('category', ['slug' => str_slug(trim($category->name), '-'), 'id' => $category->id ]) }}">
                                                <i class="fa fa-circle"></i> {{$category->name}}
                                                <i class="fa fa-plus"></i>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                @foreach ($category->subCat as $subCat)
                                                    <li><a href="{{ route('category', ['slug' => str_slug(trim($subCat->name), '-'), 'id' => $subCat->id ]) }}">{{ $subCat->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
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
    <div id="cart-right" class="hidden">
        @include('ajax.cart_right')
    </div>
</section>
@endsection

@section('script')
	<script>
		function addToCart(id) {
			var quantity = parseInt($('#quantity').val());
			console.log(quantity);
			if (isNaN(quantity) || quantity < 1) {
                $('#message-error').removeClass('hidden');
                $('#message-error-content').text('Vui lòng nhập số lượng lớn hơn 0');
            } else if (quantity > {{ $product->quantity ?? 0 }}) {
			    $('#message-error-content').text('Không đủ hàng, chỉ còn {{ $product->quantity }} sản phẩm');
                $('#message-error').removeClass('hidden');
            } else {
                $('#message-error').addClass('hidden');
                $.ajax({
                    url: "{{ route('addToCart') }}",
                    type: 'GET',
                    data: {
                        id: id,
                        quantity: quantity
                    },
                    success: function(data) {
                        console.log('data', data);
                        $('#list-cart').html(data);
                        $.ajax({
                            url: "{{ route('cartCount') }}",
                            success: function( response ) {
                                console.log(response);
                                $('#cart-count').text(response);
                                $('#message-success').removeClass('hidden');
                                setTimeout(function () {
                                    $('#message-success').addClass('hidden');
                                }, 2000)
                            }
                        });
                    }
                });
            }
		}
        $(document).ready(function() {
            $('#Carousel').carousel({
                interval: 5000
            })
            $("#show-modal-btn").click(function(){
                $("#myModal").modal();
            });
        });
	</script>
@endsection
