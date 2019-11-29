@extends('app')
@section('title') Cập nhật thông tin @endsection
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
                <p><h3 class="text-center">Cập nhật thông tin</h3></p>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" action="{{ route('user.updateProfile') }}" method="post">
                {!! csrf_field() !!}
                <span id="reauth-email" class="reauth-email"></span>
                <span>Email <span style="color: red">*</span></span>
                <input name="email" type="text" class="form-control" placeholder="Email" autofocus value="{{ $user->email ?? '' }}" autocomplete="off" readonly>
                <span>Tên hiển thị <span style="color: red">*</span></span>
                <input type="text" name="name" placeholder="Tên hiển thị" value="{{ $user->name ?? '' }}"/>
                <span>Số điện thoại</span>
                <input type="text" name="phone" placeholder="Số điện thoại" value="{{ $user->phone ?? '' }}"/>
                <span>Địa chỉ</span>
                <input type="text" name="address" placeholder="Địa chỉ" value="{{ $user->address ?? '' }}"/>
                <p><input type="checkbox" name="change_pass" id="check-change-pass"/> Đổi mật khẩu</p>
                <div id="change-pass" class="hidden">
                <span>Mật khẩu cũ<span style="color: red">*</span></span>
                    <input name="old_password" type="password" class="form-control" placeholder="Chỉ nhập khi muốn đổi mật khẩu" autocomplete="off">
                    <span>Mật khẩu mới<span style="color: red">*</span></span>
                    <input name="password" type="password" class="form-control" placeholder="Chỉ nhập khi muốn đổi mật khẩu">
                    <span>Xác nhận mật khẩu <span style="color: red">*</span></span>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Chỉ nhập khi muốn đổi mật khẩu">
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Cập nhật</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
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
            });
            $('#check-change-pass').on('change', function () {
                console.log('change', $(this).is(":checked"));
                if ($(this).is(":checked") == true) {
                    $('#change-pass').removeClass('hidden')
                } else {
                    $('#change-pass').addClass('hidden')
                }

            })
        });
    </script>
@endsection
