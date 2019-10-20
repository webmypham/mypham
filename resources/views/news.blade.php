@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container mb-20">
		<div class="container j-container">
			<div class="row product-content">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 news_post_loop">
                    @foreach ($news as $newsItem)
                        <div class="row mt-20">
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                <div class="news_post_loop_img">
                                    <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}">
                                        <img itemprop="image" src="{{ url('storage/' . $newsItem->thumbnail) }}" alt="" width="100%">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                <div class="news_post_loop_title">
                                    <h3>
                                        <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}">{{ $newsItem->title }}</a>
                                    </h3>
                                </div>
                                <div class="news_post_loop_info">
                                    <p class="cl_old">
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i> {{ Carbon\Carbon::parse($newsItem->created_at)->format('d/m/Y') }}</span>
                                    </p>
                                </div>
                                <div class="news_post_loop_content cl_old">
                                    {{ Str::limit($newsItem->description, 300) }}
                                </div>
                                <div class="news_post_loop_more">
                                    <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}" class="site-button-dark">
                                        <span>Xem chi tiết &gt;&gt; </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $news->links('vendor.pagination.bootstrap-4') }}
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
                        <div id="column-left" class="col-md-12 hidden-sm hidden-xs side-column mt-20">
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
