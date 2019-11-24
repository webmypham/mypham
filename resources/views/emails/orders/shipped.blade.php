@component('mail::message')
# Yêu cầu đặt hàng đã được tiếp nhận
{{ $mailData['user']->name }} thân mến,<br>
<p>Yêu cầu đặt hàng cho đơn hàng của bạn đã được tiếp nhận và đang chờ xử lý,<p>
<p>Thời gian đặt hàng là <b>{{ $mailData['order']->created_at }}</b><p>
<p>Chúng tôi sẽ tiếp tục cập nhật với bạn về trạng thái tiếp theo của đơn hàng.</p>

<hr>
<h2>Sản phẩm</h2>
@foreach($mailData['details'] as $key => $value)
<p style="background-color: #f0f0f0; padding: 10px 15px; margin-bottom: 15px">
    Bộ dưỡng ẩm phục hồi da Graisset Repair Moisture<br>
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
