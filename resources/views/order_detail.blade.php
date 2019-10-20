@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container mb-20">
		<div class="container j-container">
			<div class="row product-content">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 news_post_loop">
                    <h1 class="text-center">Chi tiết đơn hàng</h1>
                    @if ($order_details[0]->status != 1)
                        <form action="{{ route('user.cancelOrder') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $order_id }}" />
                            <button class="btn btn-primary pull-right mt-20 mr-10" type="submit">Hủy đơn hàng</button>
                        </form>
                    @endif

                    <p class="name mt-30">Mã đơn hàng:  {{ $order_details[0]->id_order ?? '' }}</p>

                    <p class="name">Ngày đặt:  {{ Carbon\Carbon::parse($order_details[0]->created_order_at)->format('d/m/Y') }}</p>
                    <p class="name">Trạng thái: <b style="font-size: 20px"> {{ $order_details[0]->status_text ?? ''}}</b></p>

                    <div>
                        <h4 class="mt-30">Danh sách sản phẩm:</h4>

                    </div>


                    <div class="panel-body table-responsive">
                        <!-- Table -->
                        <table class="table table-striped table-bordered" >
                            <tr>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                            <tbody>
                            @foreach($order_details as $key=>$value)
                                @if ($value->product_name)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            @if (Storage::disk()->exists($value->product_image))
                                                <img class="img-circle avatar" src="{{ asset('storage/'.$value->product_image) }}" width="50px;">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $value->product_name }}
                                        </td>
                                        <td>
                                            {{ $value->quantity }}
                                        </td>
                                        <td>
                                            {{ $value->price }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <h4 class="text-right">Tổng cộng: {{ $order_details[0]->amount ?? 0 }}</h4>
                        <hr />
                        <div class="address-1 mt-30">
                            <h3>Thông tin nhận hàng</h3>
                            <div class="mt-20">
                                <p class="name">{{  $order_details[0]->user_name }}</p>

                                <p><span>Địa chỉ: </span>{{  $order_details[0]->user_address }}</p>

                                <p><span>Điện thoại:</span> {{  $order_details[0]->user_phone }}</p>
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
