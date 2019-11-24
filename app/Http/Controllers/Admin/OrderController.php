<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchData = $request->all();
        $orders = Order::getList($searchData);
        foreach($orders as $key => $order) {
            $orders[$key]->status_text = Order::getStatusNameAttribute($order->status);
            $orders[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
        }
        return view('admin.order.index', compact(['orders', 'searchData']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::getOrderById($id);
        if (!$order) {
            // abort(404);
        }
        // hàm config gọi tới thư mục config (/const)
        $order_status = config('const.order_status');
        $disable = array_fill(0, 12, false);
        if ($order->status == 0) {
            $disable[11] = true;
        } else if ($order->status == 1) {
            $disable[0] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[10] = true;
            $disable[11] = true;
        } else if ($order->status == 2) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[11] = true;
        } else if ($order->status == 10) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[2] = true;
            $disable[11] = true;
        } else if ($order->status == 5) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[10] = true;
        } else if ($order->status == 11) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[10] = true;
            $disable[11] = true;
        }


        $order_details = DB::table('order_details')
            ->select('order_details.*', 'products.name as product_name', 'products.image as product_image')
            ->join('products', 'products.id', '=', 'order_details.id_product')
            ->where('id_order', $id)
            ->get();
        return view('admin.order.show', compact(['order', 'order_details', 'order_status', 'disable']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'status' => $request->status
        ];

        if (strval($request->status) == 11) {
            $orderDetails = OrderDetail::where('id_order', $id)->get();
            foreach ($orderDetails as $key => $detail) {
                $quantity = $detail->quantity;
                $product = Product::where('id', $detail->id_product)->first();
                $productQuantity = $product->quantity;
                $newQuantity = $productQuantity + $quantity;
                $product->update(['quantity' => $newQuantity]);
            }
        }

        Order::where('id', $id)->update($data);
        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function printBill(Request $request) {
        $id = $request->id;
        $order_status = config('const.order_status');
        $order_details = DB::table('order_details')
            ->select(
                'order_details.*',
                'orders.status',
                'orders.amount',
                'orders.id_payment',
                'orders.note',
                'orders.created_at as created_order_at',
                'products.name as product_name',
                'products.image as product_image',
                'users.name as user_name',
                'users.email as user_email',
                'users.phone as user_phone',
                'users.address as user_address'
            )
            ->leftJoin('products', 'products.id', '=', 'order_details.id_product')
            ->join('orders', 'orders.id', '=', 'order_details.id_order')
            ->join('users', 'users.id', '=', 'orders.id_user')
            ->where('id_order', $id)
            ->get()->toArray();
        foreach($order_details as $key => $order) {
            $order_details[$key]->status_text = Order::getStatusNameAttribute($order->status);
            $order_details[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
            switch ($order_details[$key]->id_payment) {
                case 1:
                    $order_details[$key]->payment = 'Nhận tiền khi giao hàng';
                    break;
                case 2:
                    $order_details[$key]->payment = 'Chuyển khoản qua ngân hàng';
                    break;
                case 3:
                    $order_details[$key]->payment = 'Thanh toán qua VTC Pay (pay.vtc.vn)';
                    break;
                default:
                    break;
            }
        }
        $order = Order::find($id);
        $order->status_text = Order::getStatusNameAttribute($order->status);
//        $data = compact('order', 'order_details');
        $content = "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
<link href=\"https://fonts.googleapis.com/css?family=Open+Sans&display=swap\" rel=\"stylesheet\" />
 <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        
        .panel-body {
            padding: 15px;
        }
        
        .table {
            width: 100%;
            display: table;
            margin: 0;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        
        table {
            background-color: transparent;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
        
        th {
            font-weight: bold;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        
    </style>
    </head>
    <body>
<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div style=\"text-align: center\">
               <img src=\"". public_path('/images/logo.png') . "\">
                <h1 style=\"color: black; margin-top: 20px\">Hóa đơn bán hàng</h1>
            </div>

            <div style=\"padding: 15px\">
                <p class=\"name mt-30\">Mã đơn hàng:  $order->id</p>

                <p class=\"name\">Ngày đặt: " . Carbon::parse($order->created_order_at)->format('d/m/Y') ."</p>
                <p class=\"name\">Trạng thái: <b style=\"font-size: 20px\">$order->status_text</b></p>
                <div>
                    <h4 class=\"mt-30\">Danh sách sản phẩm:</h4>
                    <div class=\"panel-body table-responsive\">
                        <!-- Table -->
                        <table class=\"table table-striped table-bordered\" >
                            <tr style='font-weight: 700'>
                                <th>STT</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                            </tr>
                            <tbody>";
                            foreach ($order_details as $key => $value) {
                                if ($value->product_name) {
                                    $content .= "<tr>
                                        <td>
                                            $key + 1
                                        </td>
                                        <td>";
                                            if (Storage::disk()->exists($value->product_image)) {
                                                 $content .= "<img class=\"img-circle avatar\" src = \"" . public_path('storage/'.$value->product_image). "\" width = \"50px;\" />";
                                            }
                                        $content .= "</td>
                                        <td>
                                            $value->product_name
                                        </td>
                                        <td>
                                            $value->quantity
                                        </td>
                                        <td>" . number_format($value->price, 0)
                                        . "</td>
                                    </tr>";
                                }
                            }
        $content .= "</tbody>
                        </table>
                       <h4 class=\"text-right\" style=\"color: red\">Tổng cộng:" . number_format($order_details[0]->amount, 0) . "</h4>
                <hr />
                <div class=\"address-1 mt-30\">
                    <h3>Thông tin nhận hàng</h3>
                    <div class=\"mt-20\">
                        <p class=\"name\"><span>Người nhận: </span>" .$order_details[0]->user_name . "</p>

                        <p><span>Địa chỉ: </span>" . $order_details[0]->user_address . "</p>

                        <p><span>Điện thoại:</span>" . $order_details[0]->user_phone . "</p>

                        <p><span>Hình thức thanh toán: </span>" . $order_details[0]->payment. "</p>

                        <p><span>Ghi chú: </span>" . $order_details[0]->note ."</p>
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body></html>
";

    $header = "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css\">
<link href=\"" . asset('/css/style.css') . "\" rel=\"stylesheet\">";
        $data = [
            'header' => $header,
            'content' => $content
        ];
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content)->save('bill.pdf');
        return $pdf->download('bill.pdf');
       // return view('pdf_bill', compact('order', 'order_details'));
    }
}
