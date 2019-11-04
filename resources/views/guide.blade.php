@extends('app')
@section('title') Mỹ phẩm cao cấp chính hãng @endsection
@section('content')
<section class="main-col">
	<div class="extended-container mb-20">
		<div class="container j-container">
			<div class="row product-content">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 news_post_loop fp-14">
                    <h1 class="text-center"  style="margin-top: 15px; margin-bottom: 15px">CÁCH MUA HÀNG TRÊN WEBSITE MỸ PHẨM COSMETIC</h1>
                    <p>Không cần trực tiếp đến siêu thị mua hàng, bạn có thể lựa chọn cách mua hàng online bằng cách chọn một trong những cách mua hàng sau:</p>
                    <p>Cách 1: Gọi điện thoại đến tổng đài (0981-861-865) hoặc (1800.8198) từ 7h30-21h (cả CN & ngày lễ) để đặt hàng, nhân viên chúng tôi luôn sẵn phục vụ, tư vấn và hỗ trợ quý khách mua được sản phẩm ưng ý.</p>
                    <p>Cách 2: Đặt mua hàng online trên website MyPhamCosmetic.com:</p>
                    <h2>Bước 1: Tìm sản phẩm cần mua</h2>
                    <p>Bạn có thể truy cập website MyPhamCosmetic.com để tìm và chọn sản phẩm muốn mua bằng nhiều cách:</p>
                    <p>+ Sử dụng ô tìm kiếm phía trên, gõ tên sản phẩm muốn mua (có thể tìm đích danh 1 sản phẩm, tìm theo hãng...). Website sẽ cung cấp cho bạn những gợi ý chính xác để lựa chọn:</p>
                    <img src="{{ asset('images/Picture1.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <p>+ Trang web luôn có sẵn những gợi ý sản phẩm hot nhất, có chương trình khuyến mãi hấp dẫn, bạn cũng có thể chọn xem ngay mà không cần tìm kiếm:</p>
                    <img src="{{ asset('images/Picture2.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <p>+ Sử dụng menu sản phẩm của website: chọn loại sản phẩm muốn mua là dầu gội, sữa rửa mặt, trang điểm, ...  </p>
                    <p>Sau đó tuỳ vào nhu cầu mua, bạn có thể lọc các sản phẩm theo các tiêu chí về giá, lọc sản phẩm theo loại sản phẩm, lọc sản phẩm đang có chương trình khuyến m....</p>
                    <img src="{{ asset('images/Picture3.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <h2>Bước 2: Đặt mua sản phẩm</h2>
                    <p>Sau khi chọn được sản phẩm ưng ý muốn mua, bạn tiến hành đặt hàng bằng cách:</p>
                    <p>+ Chọn vào nút THÊM VÀO GIỎ HÀNG nếu bạn muốn thanh toán vào trang GIỎ HÀNG nhấn XÁC NHẬN ĐẶT. Bạn có thể chọn thanh toán để thanh toán hết các sản phẩm trong giỏ hàng, nếu không muốn bạn có thể nhấn dấu (X) để xoá đi sản phẩm đó ra khỏi giỏ hàng</p>
                    <img src="{{ asset('images/Picture4.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <p>+ Điền đầy đủ các thông tin mua hàng theo các bước trên website bằng cách nhặp tài khoản (nếu khách hàng chưa có toài khoản thì nhấn đăng ký)</p>
                    <img src="{{ asset('images/Picture5.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <p>+ Sau đó chọn hình thức nhận hàng là giao hàng tận nơi, chọn hình thức thanh toán là trả khi nhận hàng hay thanh toán online (bằng thẻ ATM, VISA hay MasterCard) và hoàn tất đặt hàng.</p>
                    <img src="{{ asset('images/Picture6.png') }}" style="margin-top: 15px; margin-bottom: 15px">
                    <p>+ Sau khi đặt hàng thành công, Mỹ Phẩm COSMETIC sẽ liên hệ quý khách để xác nhận và hoàn tất thủ tục.</p>
                    <p>Ngoài các cách trên, để mua hàng tại Mỹ Phẩm COSMETIC quý khách còn có thể để lại bình luận tại bất kì đâu trên website (có thông tin tên, số điện thoại...), hoặc trực tiếp chat với tư vấn để được tư vấn và đặt mua sản phẩm.</p>
                    <p style="font-size: 15px; color: red">+Lưu ý:</p>
                    <p>1. Chúng tôi chỉ chấp nhận những đơn đặt hàng khi cung cấp đủ thông tin chính xác về địa chỉ, số điện thoại. Sau khi bạn đặt hàng, chúng tôi sẽ liên lạc lại để kiểm tra thông tin và thỏa thuận thêm những điều có liên quan.</p>
                    <p>2. Một số trường hợp nhạy cảm: giá trị đơn hàng quá lớn & thời gian giao hàng vào buổi tối địa chỉ giao hàng trong ngõ hoặc có thể dẫn đến nguy hiểm. Chúng tôi sẽ chủ động liên lạc với quý khách để thống nhất lại thời gian giao hàng cụ thể.</p>
                    <p>3. Trong trường hợp giao hàng chậm trễ mà không báo trước, quý khách có thể không nhận hàng và chúng tôi sẽ hoàn trả toàn bộ số tiền mà quý khách trả trước (nếu có) trong vòng 7 ngày.</p>
                    <p>4. Công ty cam kết tất cả hàng hóa gởi đến quý khách đều là hàng chính hãng mới 100% (có đầy đủ hóa đơn, được bảo hành chính thức). Những rủi ro phát sinh trong quá trình vận chuyển (va đập, ẩm ướt, tai nạn...) có thể ảnh hưởng đến hàng hóa, vì thế xin Quý Khách vui lòng kiểm tra hàng hóa thật kỹ trước khi ký nhận. Thegioididong sẽ không chịu trách nhiệm với những sai lệch hình thức của hàng hoá sau khi Quý khách đã ký nhận hàng.</p>
                    <p></p>
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
			</div>
        </div>
    </div>
</section>
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
