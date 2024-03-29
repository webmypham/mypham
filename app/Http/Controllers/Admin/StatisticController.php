<?php

namespace App\Http\Controllers\Admin;

use App\Models\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class StatisticController extends Controller
{
    public function index(Request $request) {
        $now = Carbon::now();
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        if (empty($from_date)) {
            $from_date = $now->format('Y-m-d');
        }
        if (empty($to_date)) {
            $to_date = $now->format('Y-m-d');
        }

        $revenues = 0;
        $orderAmount = DB::table('orders')
            ->whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->whereNotIn('status', [1, 11])
            ->sum('amount');
        if ($orderAmount) {
            $revenues = $orderAmount;
        }
        $sale = DB::table('orders')
            ->whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->whereNotIn('status', [1, 11])
            ->count();
        $return = DB::table('orders')
            ->whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->where('status', 11)
            ->count();
        $cancel = DB::table('orders')
            ->whereDate('created_at', '>=', $from_date)
            ->whereDate('created_at', '<=', $to_date)
            ->where('status', 1)
            ->count();
        $saleData = DB::table('orders')
            ->select('orders.*', 'users.name as customer', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
            ->whereDate('orders.created_at', '>=', $from_date)
            ->whereDate('orders.created_at', '<=', $to_date)
            ->whereNotIn('orders.status', [1, 11])
            ->get();
        $returnData = DB::table('orders')
            ->select('orders.*', 'users.name as customer', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
            ->whereDate('orders.created_at', '>=', $from_date)
            ->whereDate('orders.created_at', '<=', $to_date)
            ->where('status', 11)
            ->get();
        $cancelData = DB::table('orders')
            ->select('orders.*', 'users.name as customer', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
            ->whereDate('orders.created_at', '>=', $from_date)
            ->whereDate('orders.created_at', '<=', $to_date)
            ->where('status', 1)
            ->get();
        return view('admin.statistic.index', compact('return', 'sale', 'revenues', 'saleData', 'returnData', 'cancel', 'cancelData', 'from_date', 'to_date'));
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

    public function warehouse(Request $request) {
        $now = Carbon::now();
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $product_id = $request->product_id;

        if (empty($from_date)) {
            $from_date = $now->format('Y-m-d');
        }
        if (empty($to_date)) {
            $to_date = $now->format('Y-m-d');
        }

        $inQuantity = DB::table('receipts')
//            ->whereDate('created_at', '>=', $from_date)
//            ->whereDate('created_at', '<=', $to_date)
            ->where('type', 'in');

        $outQuantity = DB::table('receipts')
//            ->whereDate('created_at', '>=', $from_date)
//            ->whereDate('created_at', '<=', $to_date)
            ->where('type', 'out');

        $saleQuantity = DB::table('order_details');
//            ->whereDate('order_details.created_at', '>=', $from_date)
//            ->whereDate('order_details.created_at', '<=', $to_date);

        $inData = DB::table('receipts')
            ->select('receipts.*', 'users.name as user_name', 'products.name as product_name')
            ->leftJoin('users', 'receipts.user_id', 'users.id')
            ->leftJoin('products', 'receipts.product_id', 'products.id')
//            ->whereDate('receipts.created_at', '>=', $from_date)
//            ->whereDate('receipts.created_at', '<=', $to_date)
            ->where('receipts.type', 'in');

        $outData = DB::table('receipts')
            ->select('receipts.*', 'users.name as user_name', 'products.name as product_name')
            ->leftJoin('users', 'receipts.user_id', 'users.id')
            ->leftJoin('products', 'receipts.product_id', 'products.id')
//            ->whereDate('receipts.created_at', '>=', $from_date)
//            ->whereDate('receipts.created_at', '<=', $to_date)
            ->where('receipts.type', 'out');

        $saleData = DB::table('orders')
            ->select('orders.*', 'users.name as user_name', DB::raw('sum(order_details.quantity) as quantity'))
            ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
            ->leftJoin('users', 'orders.id_user', 'users.id')
            ->groupBy('order_details.id_order')
//            ->whereDate('orders.created_at', '>=', $from_date)
//            ->whereDate('orders.created_at', '<=', $to_date)
            ->whereNotIn('orders.status', [1, 11]);

        if (!empty($product_id)) {
            $inQuantity = $inQuantity->where('product_id', $product_id);
            $outQuantity = $outQuantity->where('product_id', $product_id);
            $saleQuantity = $saleQuantity->where('id_product', $product_id);
            $inData = $inData->where('receipts.product_id', $product_id);
            $outData = $outData->where('receipts.product_id', $product_id);
            $saleData = $saleData->where('order_details.id_product', $product_id);
        }

        $inQuantity = $inQuantity->sum('quantity');
        $outQuantity = $outQuantity->sum('quantity');
        $saleQuantity = $saleQuantity->sum('quantity');

        $inData = $inData->get();
        $outData = $outData->get();
        $saleData = $saleData->get();

        $remainQuantity = $inQuantity - $outQuantity - $saleQuantity;
        if ($remainQuantity < 0) $remainQuantity = 0;

        $products = Product::all();

        foreach ($products as $key => $value) {
            $value->in = Receipt::where('product_id', $value->id)->where('type', 'in')->sum('quantity');
            $value->out = Receipt::where('product_id', $value->id)->where('type', 'out')->sum('quantity');
//            $value->sale_quantity = DB::table('order_details')->where('id_product', $value->id)
//                ->leftJoin('orders', 'order_details.id_order', 'orders.id')
//                ->whereNotIn('orders.status', [1, 11])
//                ->sum('order_details.quantity');
            $sales = DB::table('orders')
                ->select('orders.*', DB::raw('order_details.quantity'))
                ->leftJoin('order_details', 'orders.id', 'order_details.id_order')
                ->groupBy('order_details.id_order')
                ->whereNotIn('orders.status', [1])
                ->where('order_details.id_product', $value->id)
//                ->sum('order_details.quantity');
                ->get();
            $quantity = 0;
            foreach ($sales as $sale) {
                $quantity += $sale->quantity;
            }
            $value->sale_quantity = $quantity;
        }


        return view('admin.statistic.warehouse', compact('inQuantity', 'outQuantity', 'saleQuantity', 'inData', 'outData', 'saleData', 'remainQuantity', 'products', 'product_id', 'from_date', 'to_date'));
    }

}
