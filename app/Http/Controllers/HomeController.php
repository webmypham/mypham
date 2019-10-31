<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index() {
        $menus = Category::getParent();
        $listProduct = [];
        foreach ($menus as $menu) {
            $subCategory = Category::getCategoryChild($menu->id);
            $catIds = array_column($subCategory, 'id');
            $products = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->whereIn('id_category', $catIds)
                ->orderBy('id', 'DESC')
                ->limit(8)
                ->get();
            foreach($products as $key => $value) {
                switch ($value->sale_type_id) {
                    case 1: 
                        $products[$key]->sale = $value->sale_value.'%';
                        $products[$key]->sale_price = $products[$key]->price - $products[$key]->price * $value->sale_value / 100;
                        break;
                    case 2: 
                        $products[$key]->sale = number_format($value->sale_value, 0).'đ';
                        $products[$key]->sale_price = $products[$key]->price - $products[$key]->sale_value;
                        break;
                    default:
                        break;
                }
            }
            $listProduct[$menu->id] = [
                'name' => $menu->name,
                'image' => $menu->image,
                'products' => $products
            ];
        }
        $news = News::latest('created_at')->limit(2)->get();
        $slides = Slide::orderBy('order', 'ASC')->get();
        return view('index', [
            'menus' => $menus,
            'listProduct' => $listProduct,
            'news' => $news,
            'slides' => $slides
        ]);
    }

    public function category($slug, $id) {
        $category = Category::find($id);
        $products = Product::getItemByCategory($id);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('category', compact('products', 'category', 'categories'));
    }

    public function product($slug, $id) {
        $product = Product::find($id);
        $products = Product::where('id_category', $product->id_category)->get()->toArray();
        $similarProducts = array_chunk($products, 6);
        $comments = Comment::where('id_product', $product->id)->get();
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('detail_product', compact('product', 'similarProducts', 'comments', 'categories'));
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
                    $quantity = $value['quantity'] + $request->quantity;
                    if ($quantity > $product->quantity) {
                        $quantcity = $product->quantity;
                    }
                    $cart[$key]['quantity'] = $quantcity;

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

    public function removeProductFromCart(Request $request) {
        $cart = [];
        if (Session::get('cart')) {
            $cart = Session::get('cart');
        }
        foreach ($cart as $key => $value) {
            if ($value['product']->id == $request->id) {
                array_splice($cart, $key, 1);
            }
        }
        Session::put('cart', $cart);
        return 'true';
    }

    public function updateCart(Request $request)
    {
        $cartData = $request->cart;
        $carts = [];
        foreach ($cartData as $cart) {
            $product = Product::find($cart['id']);
            $carts[] = [
                'product' => $product,
                'quantity' => $cart['quantity']
            ];
        }
        Session::put('cart', $carts);
        return response()->json(['status' => true], 200);
    }

    public function cart() {
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('cart', compact('categories'));
    }

    public function checkout() {
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        return view('checkout', compact('categories', 'user'));
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
        $user_id = 1;
        if (Session::get('user_logged') === true) {
            $user_id = Session::get('user_info')->id;
        }
        $order = [
            'id_user' => $user_id,
            'id_payment' => $request->id_payment,
            'status' => 0,
            'status_payment' => 0,
            'amount' => $amount,
            'note' => $request->note
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
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        return view('order', compact(['order', 'order_details', 'order_status', 'categories'], 'user'));
    }

    public function getCartCount() {
        $count = 0;
        if (Session::has('cart')) {
            $count = count(Session::get('cart'));
        }
        return $count;
    }

    public function login()
    {
        return view('login');
    }

    public function checkLogin(Request $request)
    {
        if (empty($request->email) || empty($request->password)) {
            return back()->withInput()->with('error', 'Email và mật khẩu không được để trống');
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->id_role != 2) {
                return back()->withInput()->with('error', 'Tài khoản không không có quyền truy cập');
            }
            if (Hash::check($request->password, $user->password)) {
                Session::put('user_logged', true);
                Session::put('user_info', $user);
                return redirect('/');
            } else {
                return back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
            }
        } else {
            return back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        if (empty($request->email) || empty($request->password)) {
            return back()->withInput()->with('error', 'Email và mật khẩu không được để trống');
        }
        if ($request->password != $request->confirm_password) {
            return back()->withInput()->with('error', 'Mật khẩu và xác nhận mật khẩu không khớp');
        }

        $existUser = User::where('email', $request->email)->first();
        if ($existUser) {
            return back()->withInput()->with('error', 'Email đã được sử dụng');
        }
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->id_role = 2;
        $user->save();
        Session::put('user_logged', true);
        Session::put('user_info', $user);
        return redirect('/');
    }

    public function logout() {
        Session::put('user_logged', false);
        Session::put('user_info', null);
        return redirect('/');
    }

    public function comment(Request $request)
    {
        if (empty($request->comment)) {
            return back()->withInput()->with('error', 'Vui lòng nhập bình luộn');
        }
        $comment = new Comment();
        $comment->id_product = $request->product_id;
        $comment->id_user = $request->user_id;
        $comment->content = $request->comment;
        $comment->save();

        return redirect()->back();
    }

    public function news()
    {
        $news = News::paginate(4);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('news', compact('news','categories'));
    }

    public function newsDetail(Request $request, $id)
    {
        $news = News::find($id);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('newsDetail', compact('news', 'categories'));
    }

    public function orders()
    {
        if (Session::get('user_logged') !== true) {
            return redirect('/');
        }
        $user = Session::get('user_info');
        $orders = Order::where('id_user', $user->id)->paginate(6);
        foreach($orders as $key => $order) {
            $orders[$key]->status_text = Order::getStatusNameAttribute($order->status);
            $orders[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
        }
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('orders', compact('orders', 'categories'));
    }

    public function orderDetail(Request $request, $id)
    {
        if (Session::get('user_logged') !== true) {
            return redirect('/');
        }
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
            ->get();
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
        $order_id = $id;
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }

        return view('order_detail', compact('order_details', 'order_id', 'categories'));
    }

    public function cancelOrder(Request $request) {
        $data = [
            'status' => 1
        ];
        Order::where('id', $request->id)->update($data);
        return redirect()->route('user.orders');
    }

    public function search(Request $request) {
        $keyword = $request->keyword;
        $products = Product::where('name', 'like', "%$keyword%")->get();
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('search', compact('products', 'categories', 'keyword'));
    }

    public function guide(Request $request)
    {
        return view('guide');
    }

    public function bestseller(Request $request)
    {
        $products = DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
            ->join('order_details', 'order_details.id_product', 'products.id')
            ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
            ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            ->groupBy('order_details.id_product')->orderByRaw('SUM(order_details.quantity) DESC')->limit(50)->get();
        foreach($products as $key => $value) {
            switch ($value->sale_type_id) {
                case 1:
                    $products[$key]->sale = $value->sale_value.'%';
                    $products[$key]->sale_price = $products[$key]->price - $products[$key]->price * $value->sale_value / 100;
                    break;
                case 2:
                    $products[$key]->sale = number_format($value->sale_value, 0).'đ';
                    $products[$key]->sale_price = $products[$key]->price - $products[$key]->sale_value;
                    break;
                default:
                    break;
            }
        }
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        return view('bestseller', compact('products', 'categories'));
    }
}
