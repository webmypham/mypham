<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class StatisticController extends Controller
{
    public function index() {
        $orders = Order::statistic();
        $countOrder = 0;
        foreach($orders as $key => $order) {
            $orders[$key]->status_text = Order::getStatusNameAttribute($order->status);
            $orders[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
            $countOrder += $order->order_count;
        }

        $revenues = Order::getRevenue();
        return view('admin.statistic.index', compact('orders', 'countOrder', 'revenues'));
    }
}
