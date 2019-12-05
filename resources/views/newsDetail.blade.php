@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container mb-20">
		<div class="container j-container">
			<div class="row product-content">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 news_post_loop">
                    <div id="summary2852700041858529792">
                        <div class="tintuc">
                            <h1 class="newstitle">{{ $news->title }}</h1>
                            <br>
                            <p>{!! $news->content !!}</p>
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
