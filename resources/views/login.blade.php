@extends('app')
@section('title') Đăng nhập @endsection
@section('content')
    <div class="container">


        <div class="card card-container">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
        @endif
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p><h3 class="text-center">Đăng nhập</h3></p>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="{{ route('user.login') }}" method="post">
                {!! csrf_field() !!}
                <span id="reauth-email" class="reauth-email"></span>
                <span>Email <span style="color: red">*</span></span>
                <input name="email" type="text" class="form-control" placeholder="Email" autofocus value="{{ old('email') }}" autocomplete="off">
                <span>Mật khẩu <span style="color: red">*</span></span>
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng nhập</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <div id="cart-right" class="hidden">
        @include('ajax.cart_right')
    </div>
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
