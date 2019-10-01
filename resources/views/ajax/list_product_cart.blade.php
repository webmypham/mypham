@if (Session::get('cart'))
<ul class="list-unstyled checkout toggle cart-content" style="display: block;">
    @foreach (Session::get('cart') as $item)
    <li>
        <div class="checkout-item">
            <img class="img-responsive img-thumbnail" src="{{ asset('storage/'.$item['product']->image) }}" alt="{{ $item['product']->name }}">
            <h3>
                <a href="{{ route('product', ['slug' => str_slug(trim($item['product']->name), '-'), 'id' => $item['product']->id ]) }}">{{ $item['product']->name }} x  {{ $item['quantity'] }}</a>
            </h3>
            <span class="price red pull-right">
                <em>Giá tiền:</em> 589000 
                <sup>đ</sup>
            </span>
            <div class="clearfix"></div>
        </div>
    </li>
    @endforeach
    <li>
        <div class="checkout-item">
            <button onclick="window.location='/cart'; event.preventDefault();" type="button" class="btn btn-success">Xem giỏ hàng</button>
        </div>
    </li>
</ul>
@endif