@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-10 col-sm-9 col-xs-12 no-padding-left">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding: 0 !important;">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($slides as $key => $value)
                                <li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach($slides as $key => $value)
                                <div class="item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/'.$value->image) }}" alt="Los Angeles">
                                </div>
                            @endforeach
                        </div>

                        <!-- Left and right controls -->

                    </div>
                </div>
                <div class="col-md-2 col-sm-3 hidden-xs no-padding">
                    <div class="marbot">
                        <a href="#">
                            <img class="image-responsive" src="{{ asset('images/app/r1.png') }}">
                        </a>
                    </div>
                    <div class="marbot">
                        <a href="#">
                        <img class="image-responsive" src="{{ asset('images/app/r2.png') }}">
                        </a>
                    </div>
                    <div class="marbot no-marbot hidden-sm">
                        <a href="#">
                        <img class="image-responsive" src="{{ asset('images/app/r3.png') }}">
                        </a>
                    </div>
                </div>
                <section class="main-col">
                    @foreach ($listProduct as $key => $products)
                        <div class="product-home">
                            <div class="product-title">
                                <h2>
                                <a href="{{ route('category', ['slug' => str_slug(trim($products['name']), '-'), 'id' => $key ]) }}">{{ $products['name'] }}</a>
                                </h2>
                            </div>
                            <div class="product-content row">
                                <div class="col-md-3 hidden-sm hidden-xs">
                                    <div class="banner-top">
                                        <a href="cham-soc-da-mat">
                                            @if ($products['image'])
                                                <img class="img-responsive" src="{{ asset('storage/'.$products['image']) }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="banner-bottom">
                                        <img src="https://4.bp.blogspot.com/-He3WmjstKZ4/WPm3hqfGTfI/AAAAAAAAHP0/ljZGQlyPpjAvQyybNYx0FM0_WnF34IXbACLcB/s1600/banner-logo1-1.png">
                                        <img src="https://2.bp.blogspot.com/-rdJCgP_ummU/WPm3nc_zArI/AAAAAAAAHP8/QOFOaZCxVDsMqfuIXFuqbNTbUdwMuHeyACLcB/s320/banner-logo1-2.png">
                                        <img src="https://3.bp.blogspot.com/-P_LqHTmVyuQ/WPm342XNSII/AAAAAAAAHQA/PbpfK3CgBGAQc2SwP9w-eBgfSrYUHHnnQCLcB/s1600/banner-logo1-3.png">
                                        <img src="https://3.bp.blogspot.com/-E4cox6E622o/WPm4Bz38MWI/AAAAAAAAHQE/3J8f19ZJw6cIeQOs96yttj-mW2hbhiiAwCLcB/s320/banner-logo1-4.png">
                                        <img src="https://2.bp.blogspot.com/-FdgVgaJpE88/WPm4Ikl983I/AAAAAAAAHQI/DC2vnUsMvq0NBTDRGnTH9Uz-jKtkSpbRgCLcB/s320/banner-logo1-5.png">
                                        <img src="https://1.bp.blogspot.com/-nXc4P-S7mSw/WPm4dr4r8aI/AAAAAAAAHQM/0HyIcXYN0ZAZCAsqPUz_S7PECxxkzwaNQCLcB/s1600/banner-logo1-6.png">
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-12 col-xs-12">
                                    @for ($i = 0; $i < count($products['products']); $i+=4)
                                        <div class="row">
                                            @for ($j = $i; $j < $i + 4; $j++)
                                                @if ($j < count($products['products']))
                                                <div class="col-md-3 col-sm-6 product-item">
                                                    <div class="product-box">
                                                        <div class="product-image">
                                                            <a href="{{ route('product', ['slug' => str_slug(trim($products['products'][$j]->name), '-'), 'id' => $products['products'][$j]->id ]) }}"><img src="{{ asset('storage/'.$products['products'][$j]->image) }}" alt="{{ $products['products'][$j]->name }}"></a>
                                                            @if ($products['products'][$j]->sale_value)
                                                            <div class="sale-label sale-top-right">-{{ $products['products'][$j]->sale }}</div>
                                                            @endif
                                                        </div>
                                                        <h4 class="product-name"><a href="{{ route('product', ['slug' => str_slug(trim($products['products'][$j]->name), '-'), 'id' => $products['products'][$j]->id ]) }}">{{ Str::limit($products['products'][$j]->name, 40) }}</a></h4>
                                                        @if($products['products'][$j]->status == 1)
                                                            @if ($products['products'][$j]->sale_value)
                                                                <div style="height: 35px; overflow: hidden">
                                                                    <div class="product-hover-sale">
                                                                        <div class="product-price">
                                                                            <span class="old_price">{{ number_format($products['products'][$j]->price, 0) }}₫</span>
                                                                            <span>{{ number_format($products['products'][$j]->sale_price, 0) }}₫</span>
                                                                        </div>
                                                                        @if ($products['products'][$j]->quantity > 0)
                                                                            <a style="display: none" href="javascript:void(0)" onclick="addToCart({{ $products['products'][$j]->id }})" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-cart-plus"></i>&nbsp;Mua hàng</a>
                                                                            <!-- <button class="btn btn-success" style="height: 30px; padding-top: 7px !important;" onclick="addToCart({{ $products['products'][$j]->id }})">Mua hàng</button> -->
                                                                        @else
                                                                            <a style="display: none" href="{{ route('product', ['slug' => str_slug(trim($products['products'][$j]->name), '-'), 'id' => $products['products'][$j]->id ]) }}" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            @else
                                                                <div style="height: 35px; overflow: hidden">
                                                                    <div class="product-hover">
                                                                        <p class="product-price" style="text-align: center">
                                                                            <span class="woocommerce-Price-amount product-amount">{{ number_format($products['products'][$j]->price, 0) }}<span class="woocommerce-Price-currencySymbol">₫</span></span>
                                                                        </p>
                                                                        @if ($products['products'][$j]->quantity > 0)
                                                                            <a style="display: none" href="javascript:void(0)" onclick="addToCart({{ $products['products'][$j]->id }})" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-cart-plus"></i>&nbsp;Mua hàng</a>
                                                                        @else
                                                                        <a style="display: none" href="{{ route('product', ['slug' => str_slug(trim($products['products'][$j]->name), '-'), 'id' => $products['products'][$j]->id ]) }}" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                                        @endif
                                                                    </div>

                                                                </div>

                                                            @endif
                                                        @else
                                                            <div style="height: 35px; overflow: hidden">
                                                                <div class="product-hover">
                                                                    <p class="product-price" style="text-align: center">
                                                                        <span class="product-price" style="color: #5bc0de">Sắp ra mắt</span>
                                                                    </p>
                                                                    <a href="{{ route('product', ['slug' => str_slug(trim($products['products'][$j]->name), '-'), 'id' => $products['products'][$j]->id ]) }}"" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif
                                            @endfor
                                        </div>
                                    @endfor

                                    <div class="view-more">
                                        <a href="{{ route('category', ['slug' => str_slug(trim($products['name']), '-'), 'id' => $key ]) }}"> Xem thêm </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 hidden-xs">
                                <span class="product-title-bor"></span>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="blog_content row">
                                    <div class="col-md-7 col-sm-7 col-xs-12 hidden-sm hidden-xs blog_first">
                                        <div class="blog_html_content">
                                            <p></p>
                                            <h1 style="text-align: center;">
                                                <strong><span style="color:#da1313;">Giới thiệu Cosmetic</span></strong>
                                            </h1>
                                            <p>
                                                <img src="https://1.bp.blogspot.com/-uRAUGHEd8fQ/WPnGxJrYjRI/AAAAAAAAHRc/kKK6TlMs-q8sKi5rDeSg34qwZz3KI2s2ACLcB/s1600/gioi-c3bcf87c-ece2-4990-b4ed-21b736bb0b5a.jpg" style="float: left;"> Làm đẹp luôn là nhu cầu cơ quan trọng của phái đẹp, thấu hiểu nhu cầu đó Cosmetic ra đời nhằm mang đến cho phái đẹp những sản phẩm chất lượng với chủng loại đa dạng.
                                            </p>
                                            <p>
                                                Cosmetic chuyên cung cấp mỹ phẩm thiên nhiên bao gồm chăm sóc da, chăm sóc tóc, chăm sóc toàn thân, chăm sóc cá nhân, nước hoa … đến từ các thương hiệu nổi tiếng trên thế giới. Ngoài ra Cosmetic còn có đội ngũ chuyên gia về chăm sóc sắc đẹp sẽ tư vấn chuyên sâu cho bạn về da, tóc, toàn thân giúp bạn lựa chọn được sản phẩm phù hợp nhất và mang đến vẻ ngoài đầy tự tin và cuốn hút, ai cũng có thể tự tin diện những bộ trang phục yêu thích như đầm công sở, đầm dạ tiệc, áo sơ mi, quần tây nam khi đi làm hoặc áo thun nam, áo thun nữ.
                                            </p>
                                            <p>
                                                Khi việc tìm mua mỹ phẩm chính hãng tại các shop mỹ phẩm online hoặc tại cửa hàng vẫn còn là vấn đề nan giải thì Cosmetics chính là điểm đến đáng tin cậy của bạn. Với tiêu chí mang đến cho người dùng các loại mỹ phẩm tốt hay mỹ phẩm từ thiên nhiên chính hãng, Cosmetics chỉ bán sản phẩm của những thương hiệu uy tín trong nước và trên thế giới với giá thành vô cùng hợp lý. Bên cạnh đó Cosmetics hỗ trợ giao hàng cực nhanh, thanh toán khi nhận hàng.
                                            </p>
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12 blog_block">
                                        <div class="product-title">
                                            <h2>Tin tức</h2>
                                        </div>
                                        <div class="blog-inner clearfix">
                                            <div class="row">
                                                @foreach($news as $newsItem)
                                                    <div class="blog-inner clearfix">
                                                        <div class="blog-img col-md-4 col-sm-4 col-xs-12 ">
                                                            <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}">
                                                                <img src="{{ url('storage/' . $newsItem->thumbnail) }}" alt=""></a>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                                            <h3>
                                                                <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}">{{ $newsItem->title }}</a></h3>
                                                            <p>{{ Str::limit($newsItem->description, 100) }}</p>
                                                            <p id="more-info">
                                                                    <span>
                                                                        <a href="{{ route('user.newsDetail', ['news' => $newsItem->id]) }}">Đọc thêm <i class="fa fa-angle-right"></i></a>
                                                                    </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endforeach
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
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        function addToCart(id) {
            var quantity = parseInt($('#quantity').val());
            console.log(quantity);
            $('#message-error').addClass('hidden');
            $.ajax({
                url: "{{ route('addToCart') }}",
                type: 'GET',
                data: {
                    id: id,
                    quantity: 1
                },
                success: function(data) {
                    console.log('data', data);
                    $('#list-cart').html(data['cart']);
                    $('#cart-right').html(data['cart_right']);
                    $('#cart-right').removeClass('hidden');
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
        $(document).ready(function() {
            $("#show-modal-btn").click(function(){
                $("#myModal").modal();
            });
        });
    </script>
@endsection
