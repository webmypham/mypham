<div class="basel-cart-opened">
    <div class="cart-widget-side">
        <div class="widget-heading">
            <h3 class="widget-title">Giỏ hàng</h3>
            <a href="#" class="widget-close">đóng</a>
        </div>
        <div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content" style="opacity: 1;">

                @php
                    $cartTotal = 0
                @endphp
                <ul class="woocommerce-mini-cart cart_list product_list_widget">
                    @foreach ($carts as $key => $item)
                        @php
                            $cartTotal += $item->product->price * $item->quantity
                        @endphp
                    <div id="cart_item_{{$item->product->id}}" class="cart_item" data-amount="{{ $item->product->price * $item->quantity }}" data-id="{{ $item->product->id }}"  data-quantity="{{ $item->quantity }}">
                        <li class="woocommerce-mini-cart-item mini_cart_item" >
                            <a href="javascript:void(0)" onclick="cart_remove({{ $item->product->id }}); event.preventDefault();" class="remove remove_from_cart_button">×</a>
                            <a href="{{ route('product', ['slug' => str_slug(trim($item->product->name), '-'), 'id' => $item->product->id ]) }}">
                                <img width="300" height="300" src="{{ asset('storage/'.$item->product->image) }}" >{{ $item->product->name }}
                            </a>

                            <span class="quantity">{{ $item->quantity }} × <span class="woocommerce-Price-amount amount">{{ number_format($item->product->price, 0) }}<span class="woocommerce-Price-currencySymbol">₫</span></span></span>
                        </li>
                    </div>
                    @endforeach
                </ul>

                <p class="woocommerce-mini-cart__total total"><strong>Tổng thu:</strong> <span class="woocommerce-Price-amount amount" id="cart-amount" data-total="{{ $cartTotal }}">{{ number_format($cartTotal, 0) }}<span class="woocommerce-Price-currencySymbol">₫</span></span></p>

                <div class="woocommerce-mini-cart__buttons buttons">
                    <a href="{{ route('cart') }}" class="button btn-cart wc-forward">Xem giỏ hàng</a>

                    <a href="{{ route('checkout') }}" class="button btn-cart checkout_cart wc-forward">Thanh toán</a>
                </div>
            </div></div>
    </div>
</div>
<div class="basel-close-side"></div>
<script>
    function number_format(number, decimals, dec_point, thousands_point) {

        if (number == null || !isFinite(number)) {
            throw new TypeError("number is not valid");
        }

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) {
            dec_point = '.';
        }

        if (!thousands_point) {
            thousands_point = ',';
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    }
    function cart_remove(id) {
        $('.product_list_widget[data-id="' + id + '"]');
        $.ajax({
            url: "{{ route('removeFromCart') }}",
            type: 'GET',
            data: {
                id: id,
            },
            success: function(data) {
                // window.location.reload();
                console.log(data, ".mini_cart_item");
                var total = parseInt($('#cart-amount').attr('data-total'));
                var removeTotal = parseInt($('#cart_item_' + id).attr('data-amount'));
                total = total - removeTotal;
                console.log(total);

                $('#cart_item_' + id).html('');
                $('#cart-amount').html(number_format(total, 0, '.', ',' ) + 'đ');
                console.log($('#cart_item_'), id);
                console.log($('.cart_item').length);

                if ($('.mini_cart_item').length == 0) {
                    $('#cart-right').addClass('hidden');
                    $('#cart-amount').text('0 đ');
                    $('#cart-count').text(0);
                } else {
                    $('#cart-count').text($('.mini_cart_item').length);
                }
            }
        });
    }

    $(document).ready(function () {
        $('.basel-close-side, .widget-close').on('click', function() {
            $('#cart-right').addClass('hidden');
        });
    })
</script>
