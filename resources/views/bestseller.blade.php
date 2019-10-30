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
                    <div class="spacing">
                        <ul class="breadcrumb" style="margin-top: 0">
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li class="arrow">»</li>
                            <li><strong>Bán chạy</strong></li>
                        </ul>
                    </div>
                    {{--<h1 class="heading-title">{{ $category->name }}</h1>--}}
                        @for ($i = 0; $i < count($products); $i+=4)
                            <div class="row">
                                @for ($j = $i; $j < $i + 4; $j++)
                                    @if ($j < count($products))
                                    <div class="col-md-3 col-sm-6 product-item">
                                        <div class="product-box">
                                            <div class="product-image">
                                                <a href="{{ route('product', ['slug' => str_slug(trim($products[$j]->name), '-'), 'id' => $products[$j]->id ]) }}"><img src="{{ asset('storage/'.$products[$j]->image) }}" alt="{{ $products[$j]->name }}"></a>
                                                <div class="sale-label sale-top-right">-15%</div>
                                            </div>
                                            <h4 class="product-name">
                                                <a href="{{ route('product', ['slug' => str_slug(trim($products[$j]->name), '-'), 'id' => $products[$j]->id ]) }}">{{ Str::limit($products[$j]->name, 40) }}</a>
                                            </h4>
                                            <span class="product-price"><span class="old_price">{{ number_format($products[$j]->price, 0) }}₫</span> {{ number_format($products[$j]->price, 0) }}₫</span>
                                        </div>
                                    </div>
                                    @endif
                                @endfor
                            </div>
                        @endfor
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
