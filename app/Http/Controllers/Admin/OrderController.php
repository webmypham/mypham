<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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
        if ($order->status == 1) {
            $disable[0] = true;
            $disable[2] = true;
            $disable[5] = true;
            $disable[10] = true;
            $disable[11] = true;
        } else if ($order->status == 2) {
            $disable[0] = true;
            $disable[1] = true;
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
}
