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
}
