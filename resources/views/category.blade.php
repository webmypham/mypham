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
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <h1 class="heading-title">{{ $category->name }}</h1>
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6 product-item">
                            <div class="product-box">
                                <div class="product-image">
                                    <a href="{{ route('product', ['slug' => str_slug(trim($product->name), '-'), 'id' => $product->id ]) }}"><img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"></a>
                                    <div class="sale-label sale-top-right">-15%</div>
                                </div>
                                <h4 class="product-name">
                                    <a href="{{ route('product', ['slug' => str_slug(trim($product->name), '-'), 'id' => $product->id ]) }}">{{ $product->name }}</a>
                                </h4>
                                <span class="product-price"><span class="old_price">{{ number_format($product->price, 0) }}₫</span> {{ number_format($product->price, 0) }}₫</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection