
@component('mail::message')
    <div>
@if ($mailData['type'] != 1)
    @if ($mailData['order']->status == 0)
        <div>
            <h1>Yêu cầu đặt hàng thành công</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Cosmetic rất vui thông báo đơn hàng <b>{{ "#" . $mailData['order']->id }}</b> của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Cosmetic sẽ thông báo đến quý khách ngay khi hàng được xác nhận.</p>
        </div>
    @elseif ($mailData['order']->status == 2)
        <div>
            <h1>Đã xác nhận đơn hàng</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Cosmetic rất vui thông báo đơn hàng <b>{{ $mailData['order']->id }}</b> của quý khách đã được xác nhận. Cosmetic sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
        </div>
    @elseif ($mailData['order']->status == 1)
        <div>
            <h1>Đã hủy đơn hàng</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Cosmetic xin thông báo đơn hàng <b>{{ "#" . $mailData['order']->id }}</b> của quý khách đã bị hủy. Nếu có thắc mắc hãy liên hệ với chúng tôi để được hỗ trợ.</p>
        </div>
    @elseif ($mailData['order']->status == 10)
        <div>
            <h1>Đơn hàng đang được giao</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Chúng tôi vừa bàn giao đơn hàng của quý khách đến đối tác vận chuyển</p>
        </div>
    @elseif ($mailData['order']->status == 5)
        <div>
            <h1>Đơn hàng đã được giao thành công</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Chúng tôi xin thông báo đơn hàng của quý khách đã được giao thành công</p>
        </div>
    @elseif ($mailData['order']->status == 11)
        <div>
            <h1>Đã trả hàng thành công</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Chúng tôi xin thông báo đơn hàng của quý khách đã được trả thành công</p>
        </div>
    @endif
@else
    @if ($mailData['order']->status == 0)
        <div>
            <h1>Yêu cầu đặt hàng thành công</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Cosmetic rất vui thông báo đơn hàng <b>{{ "#" . $mailData['order']->id }}</b> của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Cosmetic sẽ thông báo đến quý khách ngay khi hàng được xác nhận.</p>
        </div>
    @elseif ($mailData['order']->status == 1)
        <div>
            <h1>Yêu cầu hủy đơn hàng của bạn đã được xác nhận</h1>
            <p>Cảm ơn quý khách <b>{{  $mailData['user']->name }}</b> đã đặt hàng tại Cosmetic</p>
            <p>Nếu có thắc mắc hãy liên hệ với chúng tôi để được hỗ trợ</p>
        </div>
    @endif
@endif
<div>
    <p style="color: #1AB0EC; font-weight: bold; border-bottom: 1px solid #999">THÔNG TIN ĐƠN HÀNG {{ "#" . $mailData['order']->id }}
        <span style="color: #aaa;">(Ngày {{ \Carbon\Carbon::parse( $mailData['order']->created_at)->format('d/m/Y') }})</span>
    </p>
</div>
<div>
    <p style="font-weight: bold">Thông tin nhận hàng</p>
    <p style="font-size: 12px">{{ $mailData['user']->name }}<p>
    <p style="font-size: 12px">{{ $mailData['user']->address }}</p>
    <p style="font-size: 12px">{{ $mailData['user']->phone }}</p>
    <p style="font-size: 12px">{{ $mailData['user']->email }}</p>
</div>

    <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>
    <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
        <thead>
        <tr>
            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;width: 323px;">Sản phẩm</th>
            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
            <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
            <th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px; min-width: 100px">Tổng tạm</th>
        </tr>
        </thead>
        <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
        @foreach($mailData['details'] as $key => $value)
            <tr>
                <td align="left" style="padding:3px 9px" valign="top"><span>{{ $value['name'] }}</span><br>
                </td>
                <td align="left" style="padding:3px 9px" valign="top"><span>{{ number_format($value['price'], 0) }} đ</span></td>
                <td align="left" style="padding:3px 9px" valign="top">{{ $value['quantity'] }}</td>
                <td align="right" style="padding:3px 9px" valign="top"><span>{{ number_format($value['price'] * $value['quantity'], 0) }}đ</span></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">											<tr>
            <td align="right" colspan="3" style="padding:5px 9px">Tạm tính</td>
            <td align="right" style="padding:5px 9px"><span>{{ number_format($mailData['order']->total, 0) }}đ</span></td>
        </tr>
        <tr>
            <td align="right" colspan="3" style="padding:5px 9px">Phí vận chuyển</td>
            <td align="right" style="padding:5px 9px"><span>{{ $mailData['order']->delivery_cost == 0 ? 'Miễn phí' : (number_format($mailData['order']->delivery_cost, 0) . 'đ') }}</span></td>
        </tr>
        <tr bgcolor="#eee">
            <td align="right" colspan="3" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
            <td align="right" style="padding:7px 9px"><strong><big><span>{{ number_format($mailData['order']->amount, 0) }}đ</span> </big> </strong></td>
        </tr>
        </tfoot>
    </table>
    <div style="margin-top: 20px;margin: 10px 0 0 0;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    color: #444;
    line-height: 18px;
    font-weight: normal;">
        <p>Qúy khách có thể kiểm tra ngoại quan sản phẩm (nhãn hiệu, mẫu mã, màu sắc, số lượng, ...) trước khi thanh toán và có thể từ chối nhận hàng nếu không ưng ý.</p>
        <p>Nếu sản phẩm có dấu hiệu hư hỏng/ bể vỡ hoặc không đúng với thông tin trên website, bạn vui lòng liên hệ với chúng tôi trong vòng 48 giờ kể từ thời điểm nhận hàng để được hỗ trợ.</p>
    </div>
</div>
@endcomponent
