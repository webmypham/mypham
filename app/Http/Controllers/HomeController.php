<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $menus = Category::getParent();
        $listProduct = [];
        foreach ($menus as $menu) {
            $products = DB::table('products')
                ->where('id_category', $menu->id)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();
            $listProduct[$menu->id] = [
                'name' => $menu->name,
                'products' => $products
            ];
        }
        return view('index', [
            'menus' => $menus,
            'listProduct' => $listProduct
        ]);
    }

    public function category($slug, $id) {
        $category = Category::find($id);
        $products = Product::getItemByCategory($id);
        return view('category', compact('products', 'category'));
    }

    public function product($slug, $id) {
        $product = Product::find($id);
        $products = Product::where('id_category', $product->id_category)->get()->toArray();
        $similarProducts = array_chunk($products, 6);
        return view('detail_product', compact('product', 'similarProducts'));
    }

    public function addProductToCart(Request $request) {
        $product = Product::find($request->id);
        $cart = [];
        if (Session::get('cart')) {
            $cart = Session::get('cart');
        }
        if ($product) {
            $exist = false;
            foreach ($cart as $key => $value) {
                if ($value['product']->id == $product->id) {
                    $cart[$key]['quantity'] = $value['quantity'] + $request->quantity;
                    $exist = true;
                }
            } 
            if (!$exist) {
                $cart[] = [
                    'product' => $product,
                    'quantity' => $request->quantity
                ];
            }
        }
        Session::put('cart', $cart);
        return view('ajax.list_product_cart');
    }

    public function cart() {
        return view('cart');
    }

    public function checkout() {
        return view('checkout');
    }

    public function createOrder(Request $request) {
        $cart = Session::get('cart');
        $orderDetail = [];
        $amount = 0;
        foreach($cart as $key => $value) {
            $amount += $value['product']->price * $value['quantity'];
            $orderDetail[] = [
                'id_product' => $value['product']->id,
                'quantity'  => $value['quantity'],
                'price' => $value['product']->price
            ];
        }
        $order = [
            'id_user' => 1,
            'id_payment' => $request->id_payment,
            'status' => 0,
            'status_payment' => 0,
            'amount' => $amount
        ];
        $od = Order::create($order);
        foreach($orderDetail as $key => $value) {
            $value['id_order'] = $od->id;
            OrderDetail::create($value);
        }
        Session::forget('cart');
        return redirect(route('order', ['id' =>  $od->id]));
    }

    public function order($id) {
        $order = Order::getOrderById($id);
        $order_status = config('const.order_status');
        $order->status_text = Order::getStatusNameAttribute($order->status);
        $order->status_class = Order::getStatusClassNameAttribute($order->status);
        $order_details = DB::table('order_details')
            ->select('order_details.*', 'products.name as product_name', 'products.image as product_image')
            ->join('products', 'products.id', '=', 'order_details.id_product')
            ->where('id_order', $id)
            ->get();
        return view('order', compact(['order', 'order_details', 'order_status']));
    }

    public function getCartCount() {
        $count = 0;
        if (Session::has('cart')) {
            $count = count(Session::get('cart'));
        }
        return $count;
    }
}
