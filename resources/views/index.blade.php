@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-10 col-sm-9 col-xs-12 no-padding-left">
                    <div class="slide_index">
                        <div class="owl-carousel owl-theme" id="owl-demo" style="opacity: 1; display: block;">
                            <div class="owl-wrapper-outer">
                                <div class="owl-wrapper" style="width: 3740px; left: 0px; display: block; transition: all 1000ms ease 0s; transform: translate3d(0px, 0px, 0px);">
                                    <div class="owl-item" style="width: 935px;">
                                        <div class="item">
                                            <a href="#">
                                                <img src="https://3.bp.blogspot.com/-0RQHhK5UtbA/WPm0o_lvSmI/AAAAAAAAHPU/2UfzfiXEGgAdSSV2rRmmyGQOMHs7T337gCLcB/s1600/banner-bg.jpg">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 935px;">
                                        <div class="item">
                                            <a href="#">
                                                <img src="https://2.bp.blogspot.com/-ug9522gpq98/WPm1AsdlT8I/AAAAAAAAHPY/H2zLbV9I8VoAYnkZJCG2JT3k3smfgLocQCLcB/s1600/banner-bg2.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="owl-controls clickable">
                                <div class="owl-pagination">
                                    <div class="owl-page active"><span class=""></span></div>
                                    <div class="owl-page"><span class=""></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 hidden-xs no-padding">
                    <div class="marbot">
                        <a href="#">
                            <img class="image-responsive" src="https://4.bp.blogspot.com/-7h9GUMLfG5I/WPm2x9nunvI/AAAAAAAAHPk/AH_EZYELgbIbLba_0ix1vLomNg1QyMHOwCLcB/s1600/banner_right_1.png">
                        </a>
                    </div>
                    <div class="marbot">
                        <a href="#">
                            <img class="image-responsive" src="https://2.bp.blogspot.com/-lsUIt3zGrS8/WPm227kc4VI/AAAAAAAAHPo/MMEZyI8OlIsdj3dKlEP0jedILp-PxJspgCLcB/s1600/banner_right_2.png">
                        </a>
                    </div>
                    <div class="marbot no-marbot hidden-sm">
                        <a href="#">
                            <img class="image-responsive" src="https://3.bp.blogspot.com/-0d1T1EJEvFQ/WPm27-tFbdI/AAAAAAAAHPs/4jqRiwEQ0lEcpeR_7MiGUWpwkHoCXkELgCLcB/s1600/banner_right_3.png">
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
                                            <img class="img-responsive" src="https://1.bp.blogspot.com/-Nmpc4xoCH44/WPm3DuKAULI/AAAAAAAAHPw/WJUl5AlQNzIO0MfMWKS2CWETNQyNY4pqwCLcB/s1600/banner_left1.png">
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
                                    <div class="row">
                                        @foreach ($products['products'] as $product)
                                            <div class="col-md-3 col-sm-6 product-item">
                                                <div class="product-box">
                                                    <div class="product-image">
                                                        <a href="{{ route('product', ['slug' => str_slug(trim($product->name), '-'), 'id' => $product->id ]) }}"><img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"></a>
                                                        <div class="sale-label sale-top-right">-15%</div>
                                                    </div>
                                                    <h4 class="product-name"><a href="{{ route('product', ['slug' => str_slug(trim($product->name), '-'), 'id' => $product->id ]) }}">{{ Str::limit($product->name, 40) }}</a></h4><span class="product-price"><span class="old_price">{{ number_format($product->price, 0) }}₫</span> {{ number_format($product->price, 0) }}₫</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                                                        <div class="row">
                                                            <div class="blog-img col-md-4 col-sm-4 col-xs-12">
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
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
