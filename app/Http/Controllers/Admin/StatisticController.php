<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request) {
//        $orders = Order::statistic();
//        $countOrder = 0;
//        foreach($orders as $key => $order) {
//            $orders[$key]->status_text = Order::getStatusNameAttribute($order->status);
//            $orders[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
//            $countOrder += $order->order_count;
//        }
//
//        $revenues = Order::getRevenue();

        $now = Carbon::now();
        $month = $request->month;
        $year = $request->year;

        if (empty($month)) {
            $month = $now->month;
        }
        if (empty($year)) {
            $year = $now->year;
        }

        $revenues = 0;
        $orderAmount = DB::table('orders')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->whereNotIn('status', [1, 11])
            ->sum('amount');
        if ($orderAmount) {
            $revenues = $orderAmount;
        }
        $sale = DB::table('orders')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->whereNotIn('status', [1, 11])
            ->count();
        $return = DB::table('orders')
            ->whereMonth('created_at', '=', $month)
            ->whereYear('created_at', '=', $year)
            ->where('status', 11)
            ->count();
        $saleData = DB::table('orders')
            ->select('orders.*', 'users.name as customer', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
            ->whereMonth('orders.created_at', '=', $month)
            ->whereYear('orders.created_at', '=', $year)
            ->whereNotIn('orders.status', [1, 11])
            ->paginate(10);
        $returnData = DB::table('orders')
            ->select('orders.*', 'users.name as customer', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
            ->whereMonth('orders.created_at', '=', $month)
            ->whereYear('orders.created_at', '=', $year)
            ->where('status', 11)
            ->paginate(10);
        return view('admin.statistic.index', compact('return', 'sale', 'revenues', 'saleData', 'returnData', 'month', 'year'));
    }

    public function bestSeller(Request $request)
    {
        $now = Carbon::now();
        $month = $request->month;
        $year = $request->year;

        if (empty($month)) {
            $month = $now->month;
        }
        if (empty($year)) {
            $year = $now->year;
        }

        $products = DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name', DB::raw('SUM(order_details.quantity) as sumQuantity'))
            ->join('order_details', 'order_details.id_product', 'products.id')
            ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
            ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            ->leftJoin('categories', 'categories.id', '=','products.id_category')
            ->whereMonth('order_details.created_at', '=', $month)
            ->whereYear('order_details.created_at', '=', $year)
            ->groupBy('order_details.id_product')->orderByRaw('SUM(order_details.quantity) DESC')->limit(50)->paginate(10);
        return view('admin.statistic.bestseller', compact('products', 'month', 'year'));
    }
}
