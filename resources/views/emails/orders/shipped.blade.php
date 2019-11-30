
@component('mail::message')
@if ($mailData['type'] != 1)
    @if ($mailData['order']->status == 0)
        #Yêu cầu đặt hàng đã được tiếp nhận
        {{ $mailData['user']->name }} thân mến
        Yêu cầu đặt hàng cho đơn hàng của bạn đã được tiếp nhận và đang chờ xử lý,
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
        Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.
    @elseif ($mailData['order']->status == 2)
        #Đã xác nhận đơn hàng
        {{ $mailData['user']->name }} thân mến
        Đơn hàng của bạn đã được xác nhận
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
        Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.
    @elseif ($mailData['order']->status == 1)
        #Đã hủy đơn hàng
        {{ $mailData['user']->name }} thân mến
        Đơn hàng của bạn đã bị hủy
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
    @elseif ($mailData['order']->status == 10)
        #Đơn hàng của bạn đang được giao
        {{ $mailData['user']->name }} thân mến
        Đơn hàng của bạn đã được giao cho đơn vị vận chuyển và sẽ sớm được giao đến bạn
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
        Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.
    @elseif ($mailData['order']->status == 5)
        #Giao hàng thành công
        {{ $mailData['user']->name }} thân mến
        Đơn hàng của bạn đã được giao thành công
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
        Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.
    @elseif ($mailData['order']->status == 11)
        #Trả hàng thành công
        {{ $mailData['user']->name }} thân mến
        Đơn hàng của bạn đã trả hàng thành công
        Thời gian đặt hàng là {{ $mailData['order']->created_at }}
    @endif
    @else
        @if ($mailData['order']->status == 0)
            #Yêu cầu đặt hàng đã được tiếp nhận
            {{ $mailData['user']->name }} thân mến
            Yêu cầu đặt hàng cho đơn hàng của bạn đã được tiếp nhận và đang chờ xử lý,
            Thời gian đặt hàng là {{ $mailData['order']->created_at }}
            Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.
        @elseif ($mailData['order']->status == 1)
            #Đã hủy đơn hàng
            {{ $mailData['user']->name }} thân mến
            Bạn đã hủy đơn hàng thành công
            Thời gian đặt hàng là {{ $mailData['order']->created_at }}
        @endif

@endif
<hr>
<h2>Sản phẩm</h2>
@foreach($mailData['details'] as $key => $value)
<p style="background-color: #f0f0f0; padding: 10px 15px; margin-bottom: 15px">
    Tên sản phẩm: <br>
    <span style="color: #dd3937;">VND {{ number_format($value['price'], 0) }}</span><br>
    Số lượng: {{ $value['quantity'] }}<br>
    Thành tiền: {{ number_format($value['price'] * $value['quantity'], 0) }}
</p>
@endforeach
<hr>
<h2>Đơn hàng được giao đến</h2>
<div>
    <p>Người nhận: <b>{{ $mailData['user']->name }}</b><p>
    <p>Địa chỉ: <b>{{ $mailData['user']->address }}</b></p>
    <p>Điện thoại: <b>{{ $mailData['user']->phone }}</b></p>
    <p>Email: <b>{{ $mailData['user']->email }}</b></p>
</div>

@endcomponent
