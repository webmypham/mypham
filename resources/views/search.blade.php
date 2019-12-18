@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
    <div class="extended-container">
        <div class="container j-container">
            <div class="row product-content inner-content">
                <div class="col-sm-3 hidden-xs">
                    @include('left_nav')
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="row">
                    {{--<h1 class="heading-title">{{ $category->name }}</h1>--}}
                        @for ($i = 0; $i < count($products); $i++)
                                    <div class="col-md-3 col-sm-4 product-item">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="{{ route('product', ['slug' => str_slug(trim($products[$i]->name), '-'), 'id' => $products[$i]->id ]) }}"><img src="{{ asset('storage/'.$products[$i]->image) }}" alt="{{ $products[$i]->name }}"></a>
                                                @if ($products[$i]->sale_value)
                                                    <div class="sale-label sale-top-right">-{{ $products[$i]->sale }}</div>
                                                @endif
                                            </div>
                                            <h4 class="product-name">
                                                <a href="{{ route('product', ['slug' => str_slug(trim($products[$i]->name), '-'), 'id' => $products[$i]->id ]) }}">{{ Str::limit($products[$i]->name, 40) }}</a>
                                            </h4>
                                            @if($products[$i]->status == 1)
                                                @if ($products[$i]->sale_value)
                                                    <div style="height: 35px; overflow: hidden">
                                                        <div class="product-hover-sale">
                                                                        <span class="product-price">
                                                                                <span class="old_price">{{ number_format($products[$i]->price, 0) }}₫</span>
                                                                                {{ number_format($products[$i]->sale_price, 0) }}₫
                                                                            </span>
                                                            @if ($products[$i]->quantity > 0)
                                                                <a style="display: none" href="javascript:void(0)" onclick="addToCart({{ $products[$i]->id  }})" class="product-hover-btn product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-cart-plus"></i>&nbsp;Mua hàng</a>
                                                            @else
                                                                <a style="display: none" href="{{ route('product', ['slug' => str_slug(trim($products[$i]->name), '-'), 'id' => $products[$i]->id ]) }}" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                            @endif
                                                        </div>

                                                    </div>
                                                @else
                                                    <div style="height: 35px; overflow: hidden">
                                                        <div class="product-hover">
                                                            <p class="product-price" style="text-align: center">
                                                                {{ number_format($products[$i]->price, 0) }}₫
                                                            </p>
                                                            @if ($products[$i]->quantity > 0)
                                                                <a style="display: none" style="display: none" href="#" onclick="addToCart({{ $products[$i]->id  }})" class="product-hover-btn product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-cart-plus"></i>&nbsp;Mua hàng</a>
                                                            @else
                                                                <a style="display: none" href="{{ route('product', ['slug' => str_slug(trim($products[$i]->name), '-'), 'id' => $products[$i]->id ]) }}" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                            @endif
                                                        </div>

                                                    </div>

                                                @endif
                                            @else
                                                <div style="height: 35px; overflow: hidden">
                                                    <div class="product-hover">
                                                        <p class="product-price" style="text-align: center">
                                                            <span class="product-price" style="color: #3c2665">Sắp ra mắt</span>
                                                        </p>
                                                        <a href="{{ route('product', ['slug' => str_slug(trim($products[$i]->name), '-'), 'id' => $products[$i]->id ]) }}" class="product-hover-btn button product_type_simple add_to_cart_button ajax_add_to_cart basel-tooltip"><i class="fa fa-eye"></i>&nbsp;Xem thêm</a>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                        @endfor
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

