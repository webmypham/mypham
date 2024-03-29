<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

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
            $disable[5] = true;
            $disable[10] = true;
        } else if ($order->status == 1) {
            $disable[0] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[10] = true;
            $disable[11] = true;
        } else if ($order->status == 2) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[11] = true;
        } else if ($order->status == 10) {
            $disable[0] = true;
            $disable[1] = true;
            $disable[2] = true;
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
            ->select(
                'order_details.*',
                'products.name as product_name',
                'products.image as product_image'
            )
            ->join('products', 'products.id', '=', 'order_details.id_product')
            ->where('id_order', $id)
            ->get();
        switch ($order->id_payment) {
            case 1:
                $order->payment = 'Nhận tiền khi giao hàng';
                break;
            case 2:
                $order->payment = 'Chuyển khoản qua ngân hàng';
                break;
            case 3:
                $order->payment = 'Thanh toán qua VTC Pay (pay.vtc.vn)';
                break;
            default:
                break;
        }
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
        $order = Order::find($id);
        if ($order->status != $request->status) {
            $user = $order->users ?? '';
            $orderDetails = OrderDetail::where('id_order', $id)->get();
            $orderDetail = [];
            foreach ($orderDetails as $key => $value) {
                $orderDetail[] = [
                    'id_product' => $value->id,
                    'quantity'  => $value->quantity,
                    'price' => $value->price,
                    'name' => $value->product->name ?? ''
                ];
            }

            $data = [
                'status' => $request->status
            ];

            if (strval($request->status) == 11 || strval($request->status) == 1) {
                foreach ($orderDetails as $key => $detail) {
                    $quantity = $detail->quantity;
                    $product = Product::where('id', $detail->id_product)->first();
                    if ($product) {
                        $productQuantity = $product->quantity;
                        $productReturnQuantity = $product->return_quantity;
                        $newQuantity = $productQuantity + $quantity;
                        if (strval($request->status) == 11) {
                            $product->update(['quantity' => $newQuantity, 'return_quantity' => ($quantity + $productReturnQuantity)]);
                        } else {
                            $product->update(['quantity' => $newQuantity]);
                        }

                    }

                }


            }
            Order::where('id', $id)->update($data);
            $order->status = $request->status;
            $mailData['user'] = $user;
            $mailData['order'] = $order;
            $mailData['details'] = $orderDetail;
            $mailData['type'] = 0;
            Mail::to($user->email)->send(new OrderShipped($mailData, 'Cập nhật tình trạng đơn hàng'));

        }
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
        $details = [];
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
            $details[] = [
                'stt' => $key + 1,
                'image' =>  public_path('storage/' . $order->product_image ),
                'product_name' => $order->product_name,
                'quantity' => $order->quantity,
                'price' => $order->price
            ];
        }
        $order = Order::find($id);
        $order->status_text = Order::getStatusNameAttribute($order->status);
        $templateProcessor = new TemplateProcessor(public_path('/template/template_order.docx'));
        $templateProcessor->setValue('order_id', $order->id);
        $templateProcessor->setValue('created_at', Carbon::parse($order->created_at)->format('d/m/Y'));
        $templateProcessor->setValue('status', $order_details[0]->status_text ?? '');
        $templateProcessor->setValue('total', number_format($order->total, 0));
        $templateProcessor->setValue('shipping', number_format($order->delivery_cost, 0));
        $templateProcessor->setValue('total_amount', number_format($order->amount, 0));
        $templateProcessor->setValue('user_name', $order_details[0]->user_name ?? '');
        $templateProcessor->setValue('address', $order_details[0]->user_address ?? '');
        $templateProcessor->setValue('phone', $order_details[0]->user_phone ?? '');
        $templateProcessor->setValue('payment', $order_details[0]->payment ?? '');
        $templateProcessor->setValue('note', $order->note);

        $templateProcessor->setImageValue('comLogo', public_path('/images/logo.png'));

        $templateProcessor->cloneRow('stt', count($details));
        foreach ($details as $key => $value) {
            $key += 1;
            $templateProcessor->setValue("stt#$key", $value['stt']);
            $templateProcessor->setValue("product_name#$key", $value['product_name']);
            $templateProcessor->setValue("quantity#$key", $value['quantity']);
            $templateProcessor->setValue("price#$key", number_format($value['price'], 0));

            $templateProcessor->setImageValue("image#$key", $value['image']);
        }
        $fileName = 'Đơn hàng' . Auth::user()->id . '.docx';
        $templateProcessor->saveAs($fileName);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$fileName);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileName));
        flush();
        readfile($fileName);
        unlink($fileName);
        // return view('pdf_bill', compact('order', 'order_details'));
    }
}
