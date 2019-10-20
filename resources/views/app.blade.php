<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='blogger' name='generator'/>
        <meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
        <link href='http://www.blogger.com/openid-server.g' rel='openid.server'/>
        <link href='http://myphamaumy.blogspot.com/' rel='openid.delegate'/>
        <link href='http://myphamaumy.blogspot.com/' rel='canonical'/>

        <title>@yield('title')</title>


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'/>
        <link href="{{asset('/css/css_bundle_v2.css')}}" rel="stylesheet">
        {{-- <link href="{{asset('/css/reset.css')}}" rel="stylesheet"> --}}
        <link href="{{asset('/css/style.css')}}" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i' rel='stylesheet'/>
        {{-- <link rel="stylesheet" href="asset/css/style.css"> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style>
            .fancybox-wrap,.fancybox-skin,.fancybox-outer,.fancybox-inner,.fancybox-image,.fancybox-wrap iframe,.fancybox-wrap object,.fancybox-nav,.fancybox-nav span,.fancybox-tmp{padding:0;margin:0;border:0;outline:none;vertical-align:top;transition:none}.fancybox-wrap{position:absolute;top:0;left:0;z-index:8020}.fancybox-skin{position:relative;background:#fff;color:#444;text-shadow:none}.fancybox-opened{z-index:8030}.fancybox-outer,.fancybox-inner{position:relative}.fancybox-inner{overflow:hidden}.fancybox-type-iframe .fancybox-inner{-webkit-overflow-scrolling:touch}.fancybox-error{color:#444;font:14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;margin:0;padding:15px;white-space:nowrap}.fancybox-image,.fancybox-iframe{display:block;width:100%;height:100%}.fancybox-image{max-width:100%;max-height:100%}#fancybox-loading{position:fixed;top:50%;left:50%;margin-top:-22px;margin-left:-22px;background-position:0 -108px;opacity:.8;cursor:pointer;z-index:8060}#fancybox-loading div{width:44px;text-align:center;line-height:44px;background:url(../images/loading.gif) center center no-repeat}#fancybox-loading div:after{content:'\f29c';font-family:Ionicons}.fancybox-close{position:fixed;top:0;right:0;width:36px;height:36px;line-height:36px;cursor:pointer;z-index:8040;text-align:center;color:#fff}.fancybox-close:hover{color:#fff;text-decoration:none}.fancybox-close:after{content:'\f12a';font-family:Ionicons}.fancybox-nav{position:absolute;top:0;width:40%;height:100%;cursor:pointer;text-decoration:none;background:transparent rgba(0,0,0,0.2);-webkit-tap-highlight-color:rgba(0,0,0,0);z-index:8040}.fancybox-prev{left:-56px;color:#fff}.fancybox-prev:hover{text-decoration:none;color:#fff}.fancybox-prev:after{content:'\f124';font-family:Ionicons;width:56px;height:36px;float:left;line-height:36px;background:#27292c;position:absolute;top:50%;margin-top:-18px;left:0;text-align:center}.fancybox-next{right:-56px;color:#fff}.fancybox-next:hover{text-decoration:none;color:#fff}.fancybox-next:after{content:'\f125';font-family:Ionicons;width:56px;height:36px;float:left;line-height:36px;background:#27292c;position:absolute;top:50%;margin-top:-18px;right:0;text-align:center}.fancybox-nav span{position:absolute;top:50%;width:36px;height:34px;margin-top:-18px;cursor:pointer;z-index:8040;visibility:hidden}.fancybox-prev span{left:10px;background-position:0 -36px}.fancybox-next span{right:10px;background-position:0 -72px}.fancybox-nav:hover span{visibility:visible}.fancybox-tmp{position:absolute;top:-99999px;left:-99999px;visibility:hidden;max-width:99999px;max-height:99999px;overflow:visible!important}.fancybox-lock{overflow:hidden!important;width:auto}.fancybox-lock body{overflow:hidden!important}.fancybox-lock-test{overflow-y:hidden!important}.fancybox-overlay{position:absolute;top:0;left:0;overflow:hidden;display:none;z-index:8010;background:rgba(0, 0, 0, 0.52)}.fancybox-overlay-fixed{position:fixed;bottom:0;right:0}.fancybox-lock .fancybox-overlay{overflow:auto;overflow-y:scroll}.fancybox-title{visibility:hidden;position:relative;text-shadow:none;z-index:8050}.fancybox-opened .fancybox-title{visibility:visible}.fancybox-title-float-wrap{position:absolute;bottom:0;right:50%;margin-bottom:-35px;z-index:8050;text-align:center}.fancybox-title-float-wrap .child{display:inline-block;margin-right:-100%;padding:2px 20px;color:#29282e;font-weight:300;font-size:20px;line-height:24px;white-space:nowrap}.fancybox-title-outside-wrap{position:relative;margin-top:10px;color:#fff}.fancybox-title-inside-wrap{padding-top:10px}.fancybox-title-over-wrap{position:absolute;bottom:0;left:0;color:#fff;padding:10px;background:#000;background:rgba(0,0,0,.8)}
        </style>
        <script type='text/javascript'>
            //<![CDATA[
            $(document).ready(function(){function c(){var b=this.currentItem;$("#sync2").find(".owl-item").removeClass("synced").eq(b).addClass("synced"),void 0!==$("#sync2").data("owlCarousel")&&d(b)}function d(a){var c=b.data("owlCarousel").owl.visibleItems,d=a,e=!1;for(var f in c)if(d===c[f])var e=!0;e===!1?d>c[c.length-1]?b.trigger("owl.goTo",d-c.length+2):(d-1===-1&&(d=0),b.trigger("owl.goTo",d)):d===c[c.length-1]?b.trigger("owl.goTo",c[1]):d===c[0]&&b.trigger("owl.goTo",d-1)}$(window).scroll(function(){$(this).scrollTop()>1?$("#nav").addClass("sticky"):$("#nav").removeClass("sticky")}),$(".fa-plus").on("click",function(a){a.preventDefault();var b=$(this);return b.parents(".dropdown").find(".dropdown-menu").stop().slideToggle(),!1}),$(".fa-plus").on("click",function(a){a.preventDefault();var b=$(this);return b.parents(".level0").find(".dropdown-menu").stop().slideToggle(),!1}),$(".mobile-but").on("click",function(a){a.preventDefault();var b=$(this);return b.parents("#cate-mobile").find(".submenu").stop().slideToggle(),!1}),$(".navbar-toggle").on("click",function(a){a.preventDefault();var b=$(this);return b.parents(".mobile").find(".navbar-nav").stop().slideToggle(),!1}),$("#owl-demo").owlCarousel({autoPlay:4e3,navigation:!0,slideSpeed:300,paginationSpeed:400,singleItem:!0,navigation:!1}),$("#owl-demo2").owlCarousel({autoPlay:1e4,items:3,navigation:!0,pagination:!1,itemsDesktop:[1199,3],itemsDesktopSmall:[979,3]}),$("#owl-demo3").owlCarousel({autoPlay:1e4,items:3,navigation:!0,pagination:!1,itemsDesktop:[1199,3],itemsDesktopSmall:[979,3]}),$("#product-list").owlCarousel({autoPlay:1e4,items:3,autoPlay:!0,slideSpeed:300,navigation:!1,pagination:!1,itemsDesktop:[768,2],itemsDesktopSmall:[460,1]}),$("#product-list-2").owlCarousel({autoPlay:1e4,items:3,autoPlay:!0,slideSpeed:300,navigation:!1,pagination:!1,itemsDesktop:[768,2],itemsDesktopSmall:[460,1]}),$("#product-list-3").owlCarousel({autoPlay:1e4,items:3,autoPlay:!0,slideSpeed:300,navigation:!1,pagination:!1,itemsDesktop:[768,2],itemsDesktopSmall:[460,1]}),$("#product-list-4").owlCarousel({autoPlay:1e4,items:3,autoPlay:!0,slideSpeed:300,navigation:!1,pagination:!1,itemsDesktop:[768,2],itemsDesktopSmall:[460,1]});var a=$("#sync1"),b=$("#sync2");a.owlCarousel({singleItem:!0,slideSpeed:1e3,navigation:!0,pagination:!1,afterAction:c,responsiveRefreshRate:200}),b.owlCarousel({items:5,itemsDesktop:[1199,10],itemsDesktopSmall:[979,10],itemsTablet:[768,8],itemsMobile:[479,4],pagination:!1,responsiveRefreshRate:100,afterInit:function(a){a.find(".owl-item").eq(0).addClass("synced")}}),$("#sync2").on("click",".owl-item",function(b){b.preventDefault();var c=$(this).data("owlItem");a.trigger("owl.goTo",c)})});
        //]]></script>
    </head>
    <body class='cms-index-index cms-home-page' id='cosmetic'>
        <header>
            <div class="header-top hidden-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p>
                                Tư vấn miễn phí 24/7 - Giao hàng nhanh chóng
                            </p>
                        </div>
                        @if (Session::get('user_logged') === true)
                            <div class="col-md-6 col-sm-6" id="open_shopping_cart">
                                <div class="login">
                                    <a class="my-account" href="/logout">
                                        Đăng xuất
                                    </a>

                                </div>
                                <div class="login">
                                    Xin chào <b>{{ Session::get('user_info')->name }}</b>
                                </div>
                            </div>
                         @else
                            <div class="col-md-6 col-sm-6" id="open_shopping_cart">
                                <div class="login">
                                    <a class="my-account" href="/login">
                                        Đăng nhập
                                        </a>
                                </div>
                                <div class="login">
                                    <a class="my-account" href="/register">
                                        Đăng ký
                                    </a>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12" id="logo">
                            <div class="navbar-header">
                                <a class="logo" href="/">
                                    <img alt="cosmetic" src="https://4.bp.blogspot.com/-xvy-pe0pzPQ/WPmzmICA8sI/AAAAAAAAHPI/7ujkA-qA5gcdpNbLCllV0_2L6Q_N3kJnwCLcB/s1600/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-4 hidden-xs">
                            <div class="header-hotline">
                                <img src="https://4.bp.blogspot.com/-vwEre7XGhOc/WPmz4E8t0eI/AAAAAAAAHPM/kfjlYdc5O00NfNv8HyBDdVswu__BH38BwCLcB/s1600/header-hotline.png">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 pull-right">
                            <form action="/search" class="search-form" id="search_mini_form" method="get">
                                <input id="search" maxlength="70" name="query" placeholder="Từ khóa cần tìm kiếm" type="text" value="">
                                <button type="submit" value="Tìm kiếm">
                                    Tìm kiếm
                                </button>
                            </form>
                        </div>
                        <!-- end col-6 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end top-bar -->
            <nav class="navbar navbar-default hidden-sm hidden-xs" id="nav" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class=" col-xs-12 col-sm-11 no-padding">
                                <div class="no-padding" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li class="">
                                            <a href="/">Trang chủ</a>
                                        </li>
                                        @foreach (get_menu_prent() as $menu)
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" href="{{ route('category', ['slug' => str_slug(trim($menu->name), '-'), 'id' => $menu->id ]) }}">
                                                    {{ $menu->name }} 
                                                    @if (count(get_menu_child($menu->id)) > 0)
                                                    <i class="fa fa-angle-down"></i>
                                                    @endif 
                                                </a>
                                                @if (count(get_menu_child($menu->id)) > 0)
                                                <ul class="dropdown-menu" role="menu">
                                                    @foreach (get_menu_child($menu->id) as $menuChilds)
                                                    <li><a href="{{ route('category', ['slug' => str_slug(trim($menuChilds->name), '-'), 'id' => $menuChilds->id ]) }}">{{ $menuChilds->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" href="/search/label/san-pham">Liên hệ </a>
                                        </li>
                                        <li class="">
                                            <a href="{{ url('/news') }}">Tin tức</a>
                                        </li>
                                        @if (Session::get('user_logged') === true)
                                            <li class="">
                                                <a href="{{ url('/orders') }}">Đơn hàng</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-12 ">
                                <div class="item-menu">
                                    <a href="{{ route('cart') }}">
                                        <span class="cart-counter simpleCart_quantity" id="cart-count">
                                            @if (Session::get('cart'))
                                            {{ count(Session::get('cart')) }}
                                            @else
                                            0
                                            @endif
                                        </span>
                                        <img id="icon-cart" src="https://1.bp.blogspot.com/-BEJFhm2rQ8o/WPm0OKSRqXI/AAAAAAAAHPQ/CaExJP4W-wYVTHM1iK62SsNka7-1nckawCLcB/s1600/cart.png">
                                    </a>
                                    <div class="cart-droplist hidden-xs">
                                        <div class="top-cart-content arrow_box dd-menu" style="display: none;">
                                            <div class="block-subtitle">
                                                <i aria-hidden="true" class="fa fa-check"></i>
                                                <span class="cart-counter-list simpleCart_quantity">
                                                    @if (Session::get('cart'))
                                                    {{ count(Session::get('cart')) }}
                                                    @endif
                                                </span> Sản phẩm trong giỏ hàng
                                            </div>
                                           <div id="list-cart">
                                               @include('ajax.list_product_cart')
                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end navbar-collapse -->
                        </div>
                        <!-- end col-12 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </nav>
            <!-- end nav -->
        </header>

        <section id="main">
            @yield('content')
        </section>

        <footer>
            <div class="container footer-mid">
                <div class="row">
                    <div class="col1 col-md-4 col-sm-4">
                        <div class="logo-footer">
                            <a href="/"><img class="image-responsive" src="https://4.bp.blogspot.com/-cOij6akgvXI/WPnHK0T3piI/AAAAAAAAHRg/0B3__YYlSPMHbaKOWj86HYKTN1OWlQXMwCLcB/s1600/banner_blog.jpg"></a>
                        </div>
                    </div>
                    <div class="col1 col-md-4 col-sm-4">
                        <h4>Giới thiệu và chính sách</h4>
                        <ul class="footer_col_top">
                            <li><i class="fa fa-star"></i><a href="">Về Cosmetic</a></li>
                            <li><i class="fa fa-star"></i><a href="">Hướng dẫn thanh toán</a></li>
                            <li><i class="fa fa-star"></i><a href="">Chính sách vận chuyển</a></li>
                            <li><i class="fa fa-star"></i><a href=""> Hướng dẫn mua hàng</a></li>
                            <li><i class="fa fa-star"></i><a href="">Chính sách đổi trả</a></li>
                        </ul>
                    </div>
                    <div class="col1 col-md-4 col-sm-4 ">
                        <h4>Địa chỉ cửa hàng</h4>
                        <div class="">
                            <p><i class="fa fa-map-marker"></i> 442 Đội Cấn - Ba Đình - Hà Nội</p>
                            <p><i class="fa fa-phone"></i> 0981 861 865</p>
                            <p><i class="fa fa-envelope"></i> thuthanh250@gmail.com</p>
                            <p><i class="fa fa-globe"></i>www.azatemplate.com</p>
                        </div>
                        <div class="footer_hotline">
                            <p>Hotline: 0981 861 865</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="sub-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="copyright">&copy; Copyright Thanh Thanh</span>
                            <a href="#" id="backtotop" style="display: inline-block;"><i class="fa fa-angle-up"></i></a>
                        </div>
                        <!-- end col-9 -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end sub-footer -->
        </footer>

        <script type="text/javascript">
            //<![CDATA[
            /* #jQuery jGrowl
            ================================================== */
            (function(e){var t=function(){return!1===e.support.boxModel&&e.support.objectAll&&e.support.leadingWhitespace}();e.jGrowl=function(t,i){0==e("#jGrowl").size()&&e('<div id="jGrowl"></div>').addClass(i&&i.position?i.position:e.jGrowl.defaults.position).appendTo("body"),e("#jGrowl").jGrowl(t,i)},e.fn.jGrowl=function(t,i){if(e.isFunction(this.each)){var o=arguments;return this.each(function(){void 0==e(this).data("jGrowl.instance")&&(e(this).data("jGrowl.instance",e.extend(new e.fn.jGrowl,{notifications:[],element:null,interval:null})),e(this).data("jGrowl.instance").startup(this)),e.isFunction(e(this).data("jGrowl.instance")[t])?e(this).data("jGrowl.instance")[t].apply(e(this).data("jGrowl.instance"),e.makeArray(o).slice(1)):e(this).data("jGrowl.instance").create(t,i)})}},e.extend(e.fn.jGrowl.prototype,{defaults:{pool:0,header:"",group:"",sticky:!1,position:"top-right",glue:"after",theme:"default",themeState:"highlight",corners:"10px",check:250,life:3e3,closeDuration:"normal",openDuration:"normal",easing:"swing",closer:!0,closeTemplate:"<i class='icon-cancel'></i>",closerTemplate:"<div>[ close all ]</div>",log:function(){},beforeOpen:function(){},afterOpen:function(){},open:function(){},beforeClose:function(){},close:function(){},animateOpen:{opacity:"show"},animateClose:{opacity:"hide"}},notifications:[],element:null,interval:null,create:function(t,i){var i=e.extend({},this.defaults,i);i.speed!==void 0&&(i.openDuration=i.speed,i.closeDuration=i.speed),this.notifications.push({message:t,options:i}),i.log.apply(this.element,[this.element,t,i])},render:function(t){var i=this,o=t.message,n=t.options;n.themeState=""==n.themeState?"":"ui-state-"+n.themeState;var t=e("<div/>").addClass("jGrowl-notification "+n.themeState+" ui-corner-all"+(void 0!=n.group&&""!=n.group?" "+n.group:"")).append(e("<div/>").addClass("jGrowl-close").attr("title", "Close").html(n.closeTemplate)).append(e("<div/>").addClass("jGrowl-header").html(n.header)).append(e("<div/>").addClass("jGrowl-message").html(o)).data("jGrowl",n).addClass(n.theme).children("div.jGrowl-close").bind("click.jGrowl",function(){e(this).parent().trigger("jGrowl.beforeClose")}).parent();e(t).bind("mouseover.jGrowl",function(){e("div.jGrowl-notification",i.element).data("jGrowl.pause",!0)}).bind("mouseout.jGrowl",function(){e("div.jGrowl-notification",i.element).data("jGrowl.pause",!1)}).bind("jGrowl.beforeOpen",function(){n.beforeOpen.apply(t,[t,o,n,i.element])!==!1&&e(this).trigger("jGrowl.open")}).bind("jGrowl.open",function(){n.open.apply(t,[t,o,n,i.element])!==!1&&("after"==n.glue?e("div.jGrowl-notification:last",i.element).after(t):e("div.jGrowl-notification:first",i.element).before(t),e(this).animate(n.animateOpen,n.openDuration,n.easing,function(){e.support.opacity===!1&&this.style.removeAttribute("filter"),null!==e(this).data("jGrowl")&&(e(this).data("jGrowl").created=new Date),e(this).trigger("jGrowl.afterOpen")}))}).bind("jGrowl.afterOpen",function(){n.afterOpen.apply(t,[t,o,n,i.element])}).bind("jGrowl.beforeClose",function(){n.beforeClose.apply(t,[t,o,n,i.element])!==!1&&e(this).trigger("jGrowl.close")}).bind("jGrowl.close",function(){e(this).data("jGrowl.pause",!0),e(this).animate(n.animateClose,n.closeDuration,n.easing,function(){e.isFunction(n.close)?n.close.apply(t,[t,o,n,i.element])!==!1&&e(this).remove():e(this).remove()})}).trigger("jGrowl.beforeOpen"),""!=n.corners&&void 0!=e.fn.corner&&e(t).corner(n.corners),e("div.jGrowl-notification:parent",i.element).size()>1&&0==e("div.jGrowl-closer",i.element).size()&&this.defaults.closer!==!1&&e(this.defaults.closerTemplate).addClass("jGrowl-closer "+this.defaults.themeState+" ui-corner-all").addClass(this.defaults.theme).appendTo(i.element).animate(this.defaults.animateOpen,this.defaults.speed,this.defaults.easing).bind("click.jGrowl",function(){e(this).siblings().trigger("jGrowl.beforeClose"),e.isFunction(i.defaults.closer)&&i.defaults.closer.apply(e(this).parent()[0],[e(this).parent()[0]])})},update:function(){e(this.element).find("div.jGrowl-notification:parent").each(function(){void 0!=e(this).data("jGrowl")&&void 0!==e(this).data("jGrowl").created&&e(this).data("jGrowl").created.getTime()+parseInt(e(this).data("jGrowl").life)<(new Date).getTime()&&e(this).data("jGrowl").sticky!==!0&&(void 0==e(this).data("jGrowl.pause")||e(this).data("jGrowl.pause")!==!0)&&e(this).trigger("jGrowl.beforeClose")}),this.notifications.length>0&&(0==this.defaults.pool||e(this.element).find("div.jGrowl-notification:parent").size()<this.defaults.pool)&&this.render(this.notifications.shift()),2>e(this.element).find("div.jGrowl-notification:parent").size()&&e(this.element).find("div.jGrowl-closer").animate(this.defaults.animateClose,this.defaults.speed,this.defaults.easing,function(){e(this).remove()})},startup:function(i){this.element=e(i).addClass("jGrowl").append('<div class="jGrowl-notification"></div>'),this.interval=setInterval(function(){e(i).data("jGrowl.instance").update()},parseInt(this.defaults.check)),t&&e(this.element).addClass("ie6")},shutdown:function(){e(this.element).removeClass("jGrowl").find("div.jGrowl-notification").trigger("jGrowl.close").parent().empty(),clearInterval(this.interval)},close:function(){e(this.element).find("div.jGrowl-notification").each(function(){e(this).trigger("jGrowl.beforeClose")})}}),e.jGrowl.defaults=e.fn.jGrowl.prototype.defaults})(jQuery);
            //]]>
        </script>

        <script type="text/javascript">
        // Back to top
            $(document).ready(function(e){
                var t=e("#backtotop");
                e(window).scroll(function(){
                    e(this).scrollTop()>=800?t.show(10).animate({opacity:"1"},10):t.animate({opacity:"0"},10)});
                    t.click(function(t){
                        t.preventDefault();
                        e("html,body").animate({scrollTop:0},400);
                    });
            });
        </script>
        <script type="text/javascript" src="https://www.blogger.com/static/v1/widgets/3680708148-widgets.js"></script>
        <script type="text/javascript">
            window['__wavt'] = 'AOuZoY6TfInrlQt4gbXGeKEwxSZOKPER2A:1565819624685';_WidgetManager._Init('//www.blogger.com/rearrange?blogID\x3d1145915791316203422','//myphamaumy.blogspot.com/','1145915791316203422');
            _WidgetManager._SetDataContext([{'name': 'blog', 'data': {'blogId': '1145915791316203422', 'title': 'Blog Mỹ Phẩm Âu Mỹ', 'url': 'https://myphamaumy.blogspot.com/', 'canonicalUrl': 'http://myphamaumy.blogspot.com/', 'homepageUrl': 'https://myphamaumy.blogspot.com/', 'searchUrl': 'https://myphamaumy.blogspot.com/search', 'canonicalHomepageUrl': 'http://myphamaumy.blogspot.com/', 'blogspotFaviconUrl': 'https://myphamaumy.blogspot.com/favicon.ico', 'bloggerUrl': 'https://www.blogger.com', 'hasCustomDomain': false, 'httpsEnabled': true, 'enabledCommentProfileImages': true, 'gPlusViewType': 'FILTERED_POSTMOD', 'adultContent': false, 'analyticsAccountNumber': '', 'encoding': 'UTF-8', 'locale': 'vi', 'localeUnderscoreDelimited': 'vi', 'languageDirection': 'ltr', 'isPrivate': false, 'isMobile': false, 'isMobileRequest': false, 'mobileClass': '', 'isPrivateBlog': false, 'feedLinks': '\x3clink rel\x3d\x22alternate\x22 type\x3d\x22application/atom+xml\x22 title\x3d\x22Blog Mỹ Phẩm Âu Mỹ - Atom\x22 href\x3d\x22https://myphamaumy.blogspot.com/feeds/posts/default\x22 /\x3e\n\x3clink rel\x3d\x22alternate\x22 type\x3d\x22application/rss+xml\x22 title\x3d\x22Blog Mỹ Phẩm Âu Mỹ - RSS\x22 href\x3d\x22https://myphamaumy.blogspot.com/feeds/posts/default?alt\x3drss\x22 /\x3e\n\x3clink rel\x3d\x22service.post\x22 type\x3d\x22application/atom+xml\x22 title\x3d\x22Blog Mỹ Phẩm Âu Mỹ - Atom\x22 href\x3d\x22https://www.blogger.com/feeds/1145915791316203422/posts/default\x22 /\x3e\n', 'meTag': '', 'adsenseHostId': 'ca-host-pub-1556223355139109', 'adsenseHasAds': false, 'ieCssRetrofitLinks': '\x3c!--[if IE]\x3e\x3cscript type\x3d\x22text/javascript\x22 src\x3d\x22https://www.blogger.com/static/v1/jsbin/1888308728-ieretrofit.js\x22\x3e\x3c/script\x3e\n\x3c![endif]--\x3e', 'view': '', 'dynamicViewsCommentsSrc': '//www.blogblog.com/dynamicviews/4224c15c4e7c9321/js/comments.js', 'dynamicViewsScriptSrc': '//www.blogblog.com/dynamicviews/1581ed35ea803b4e', 'plusOneApiSrc': 'https://apis.google.com/js/plusone.js', 'disableGComments': true, 'sharing': {'platforms': [{'name': 'Nhận liên kết', 'key': 'link', 'shareMessage': 'Nhận liên kết', 'target': ''}, {'name': 'Facebook', 'key': 'facebook', 'shareMessage': 'Chia sẻ với Facebook', 'target': 'facebook'}, {'name': 'BlogThis!', 'key': 'blogThis', 'shareMessage': 'BlogThis!', 'target': 'blog'}, {'name': 'Twitter', 'key': 'twitter', 'shareMessage': 'Chia sẻ với Twitter', 'target': 'twitter'}, {'name': 'Pinterest', 'key': 'pinterest', 'shareMessage': 'Chia sẻ với Pinterest', 'target': 'pinterest'}, {'name': 'Email', 'key': 'email', 'shareMessage': 'Email', 'target': 'email'}], 'disableGooglePlus': true, 'googlePlusShareButtonWidth': 300, 'googlePlusBootstrap': '\x3cscript type\x3d\x22text/javascript\x22\x3ewindow.___gcfg \x3d {\x27lang\x27: \x27vi\x27};\x3c/script\x3e'}, 'hasCustomJumpLinkMessage': false, 'jumpLinkMessage': 'Đọc thêm', 'pageType': 'index', 'pageName': '', 'pageTitle': 'Blog Mỹ Phẩm Âu Mỹ'}}, {'name': 'features', 'data': {'sharing_get_link_dialog': 'true', 'sharing_native': 'false'}}, {'name': 'messages', 'data': {'edit': 'Chỉnh sửa', 'linkCopiedToClipboard': 'Đã sao chép liên kết vào khay nhớ tạm!', 'ok': 'Ok', 'postLink': 'Liên kết bài đăng'}}, {'name': 'template', 'data': {'name': 'custom', 'localizedName': 'Tùy chỉnh', 'isResponsive': false, 'isAlternateRendering': false, 'isCustom': true}}, {'name': 'view', 'data': {'classic': {'name': 'classic', 'url': '?view\x3dclassic'}, 'flipcard': {'name': 'flipcard', 'url': '?view\x3dflipcard'}, 'magazine': {'name': 'magazine', 'url': '?view\x3dmagazine'}, 'mosaic': {'name': 'mosaic', 'url': '?view\x3dmosaic'}, 'sidebar': {'name': 'sidebar', 'url': '?view\x3dsidebar'}, 'snapshot': {'name': 'snapshot', 'url': '?view\x3dsnapshot'}, 'timeslide': {'name': 'timeslide', 'url': '?view\x3dtimeslide'}, 'isMobile': false, 'title': 'Blog Mỹ Phẩm Âu Mỹ', 'description': '', 'url': 'https://myphamaumy.blogspot.com/', 'type': 'feed', 'isSingleItem': false, 'isMultipleItems': true, 'isError': false, 'isPage': false, 'isPost': false, 'isHomepage': true, 'isArchive': false, 'isLabelSearch': false}}]);
            _WidgetManager._RegisterWidget('_BlogView', new _WidgetInfo('Blog1', 'mainblog', document.getElementById('Blog1'), {'cmtInteractionsEnabled': false, 'lightboxEnabled': true, 'lightboxModuleUrl': 'https://www.blogger.com/static/v1/jsbin/3877460894-lbx__vi.js', 'lightboxCssUrl': 'https://www.blogger.com/static/v1/v-css/368954415-lightbox_bundle.css'}, 'displayModeFull'));
        </script>
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml            : true,
                    version          : 'v4.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your customer chat code -->
        <div class="fb-customerchat"
             attribution=setup_tool
             page_id="1864780080465322">
        </div>
        @yield('script')
    </body>
</html>
