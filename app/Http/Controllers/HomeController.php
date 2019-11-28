<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request; //xử lý yêu cầu từ phía ng dùng gửi lên
use Illuminate\Support\Carbon; //thư viện xử lý ngày tháng
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; //mã hoá mk và giải mã mk
//config/Session.php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session; //phiên làm việc (khoảng thời gian)

class HomeController extends Controller
{
    // Trang chủ
    public function index() {
        DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
            ->join('sale', function($join) {
                $join->on('sale.id', '=', 'products.sale_id');
            })
            ->whereDate('sale.date_end', '<', Carbon::now()->format('Y-m-d'))
            ->delete();
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
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('index', [
            'menus' => $menus,
            'listProduct' => $listProduct,
            'news' => $news,
            'slides' => $slides,
            'carts' => $carts
        ]);
    }

    // trang xem sản phẩm theo danh mục
    public function category($slug, $id) {
        $category = Category::find($id);
        $products = Product::getItemByCategory($id);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('category', compact('carts', 'products', 'category', 'categories'));
    }

    // Trang chi tiết sản phẩm
    public function product($slug, $id) {
        $product = DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
            ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
            ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
            ->where('products.id', $id)
            ->first();
        switch ($product->sale_type_id) {
            case 1:
                $product->sale = $product->sale_value.'%';
                $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                break;
            case 2:
                $product->sale = number_format($product->sale_value, 0).'đ';
                $product->sale_price = $product->price - $product->sale_value;
                break;
            default:
                break;
        }
        $products = Product::where('id_category', $product->id_category)->get()->toArray();
        $similarProducts = array_chunk($products, 6);
        $comments = Comment::where('id_product', $product->id)->get();
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $productCart = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($productCart->sale_type_id) {
                case 1:
                    $productCart->sale = $productCart->sale_value.'%';
                    $productCart->sale_price = $productCart->price - $productCart->price * $productCart->sale_value / 100;
                    break;
                case 2:
                    $productCart->sale = number_format($productCart->sale_value, 0).'đ';
                    $productCart->sale_price = $productCart->price - $productCart->sale_value;
                    break;
                default:
                    break;
            }
            $productCart->price = $productCart->sale_price ?? $product->price;
            $value->product = $productCart;
        }
        return view('detail_product', compact('product', 'similarProducts', 'comments', 'categories', 'carts'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addProductToCart(Request $request) {
        $user = Session::get('user_info');
        $product = Product::find($request->id);
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $cart = Cart::where('user_id', $userId)->where('product_id', $request->id)->first();
        if ($product) {
            if ($cart) {
                $cart->quantity = $cart->quantity + $request->quantity;
                $cart->save();
            } else {

                $newCart = new Cart();
                $newCart->user_id = $userId;
                $newCart->product_id = $request->id;
                $newCart->quantity = $request->quantity;
                $newCart->save();
            }
        }
        if ($user) {
            $carts = Cart::where('user_id', $user->id)->get();
        } else {
            $carts = Cart::where('user_id', -1)->get();
        }

        return view('ajax.list_product_cart', compact('carts'));
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeProductFromCart(Request $request) {
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $cart = Cart::where('user_id', $userId)->where('product_id', $request->id)->first();
        if ($cart) {
            $cart->delete();
        }
        return 'true';
    }

    // Cập nhật giỏ hàng
    public function updateCart(Request $request)
    {
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $cartData = $request->cart;
        foreach ($cartData as $value) {
            $cart = Cart::where('user_id', $userId)->where('product_id', $value['id'])->first();
            if ($cart) {
                $cart->quantity = $value['quantity'];
                $cart->save();
            }
        }
        return response()->json(['status' => true], 200);
    }

    // Trang giỏ hàng
    public function cart() {
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }

        return view('cart', compact('carts', 'categories'));
    }

    // Trang đặt hàng
    public function checkout() {
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $carts = [];
        if ($user) {
            $carts = Cart::where('user_id', $user->id)->get();
            foreach ($carts as $value) {
                $product = DB::table('products')
                    ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                    ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                    ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                    ->where('products.id', $value->product_id)
                    ->first();
                switch ($product->sale_type_id) {
                    case 1:
                        $product->sale = $product->sale_value.'%';
                        $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                        break;
                    case 2:
                        $product->sale = number_format($product->sale_value, 0).'đ';
                        $product->sale_price = $product->price - $product->sale_value;
                        break;
                    default:
                        break;
                }
                $product->price = $product->sale_price ?? $product->price;
                $value->product = $product;
            }
        }

        return view('checkout', compact('categories', 'user', 'carts'));
    }

    // Tạo đơn hàng -> khi nhấn nút thanh toán
    public function createOrder(Request $request) {
        $user = Session::get('user_info');
        $cart = Cart::where('user_id', $user->id)->get();
        foreach ($cart as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        $orderDetail = [];
        $amount = 0;
        $mailData = [];
        foreach($cart as $key => $value) {
            $amount += $value->product->price * $value->quantity;
            $orderDetail[] = [
                'id_product' => $value->product->id,
                'quantity'  => $value->quantity,
                'price' => $value->product->price
            ];
            $product = Product::find($value->product->id);
            $newQuantity = 0;
            if ($product->quantity >= $value->quantity) {
                $newQuantity = $product->quantity - $value->quantity;
            } else {
                $value->product->quantity = $product->quantity;
                return back()->withInput()->with('error', 'Không dủ hàng vui lòng kiểm tra lại giỏ hàng');
            }
            $product->update(['quantity' => $newQuantity]);
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
        Cart::where('user_id', $user->id)->delete();
        $mailData['user'] = $user;
        $mailData['order'] = $od;
        $mailData['details'] = $orderDetail;
        Mail::to($user->email)->send(new OrderShipped($mailData));
        return redirect(route('order', ['id' =>  $od->id]))->with('success', 'Đặt hàng thành công');;
    }

    // Trang đặt hàng thành công
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
        $carts = [];
        if ($user) {
            $carts = Cart::where('user_id', $user->id)->get();
            foreach ($carts as $value) {
                $product = DB::table('products')
                    ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                    ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                    ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                    ->where('products.id', $value->product_id)
                    ->first();
                switch ($product->sale_type_id) {
                    case 1:
                        $product->sale = $product->sale_value.'%';
                        $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                        break;
                    case 2:
                        $product->sale = number_format($product->sale_value, 0).'đ';
                        $product->sale_price = $product->price - $product->sale_value;
                        break;
                    default:
                        break;
                }
                $product->price = $product->sale_price ?? $product->price;
                $value->product = $product;
            }
        }
        return view('order', compact(['order', 'order_details', 'order_status', 'categories'], 'user', 'carts'));
    }


    // Đếm số lượng sản phẩm trong giỏ hàng
    public function getCartCount() {
        $user = Session::get('user_info');
        $count = 0;
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $count = count(Cart::where('user_id', $userId)->get());
        return $count;
    }

    // Trang đăng nhập
    public function login()
    {
        $user = Session::get('user_info');
        $carts = [];
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        if ($user) {
            $carts = Cart::where('user_id', $userId)->get();
            foreach ($carts as $value) {
                $product = DB::table('products')
                    ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                    ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                    ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                    ->where('products.id', $value->product_id)
                    ->first();
                switch ($product->sale_type_id) {
                    case 1:
                        $product->sale = $product->sale_value.'%';
                        $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                        break;
                    case 2:
                        $product->sale = number_format($product->sale_value, 0).'đ';
                        $product->sale_price = $product->price - $product->sale_value;
                        break;
                    default:
                        break;
                }
                $product->price = $product->sale_price ?? $product->price;
                $value->product = $product;
            }
        }
        return view('login', compact('carts'));
    }

    // Kiểm tra đăng nhập -> Khi nhấn nút đăng nhâp
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
                $userId = -1;
                Cart::where('user_id', $userId)->update(['user_id' => $user->id]);
                Cart::where('user_id', -1)->delete();
                return redirect('/');
            } else {
                return back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
            }
        } else {
            return back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    // Trang đăng ký
    public function registerView()
    {
        $user = Session::get('user_info');
        $carts = [];
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        if ($user) {
            $carts = Cart::where('user_id', $userId)->get();
            foreach ($carts as $value) {
                $product = DB::table('products')
                    ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                    ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                    ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                    ->where('products.id', $value->product_id)
                    ->first();
                switch ($product->sale_type_id) {
                    case 1:
                        $product->sale = $product->sale_value.'%';
                        $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                        break;
                    case 2:
                        $product->sale = number_format($product->sale_value, 0).'đ';
                        $product->sale_price = $product->price - $product->sale_value;
                        break;
                    default:
                        break;
                }
                $product->price = $product->sale_price ?? $product->price;
                $value->product = $product;
            }
        }
        return view('register', compact('carts'));
    }

    // Xử lý đăng ký, khi nhấn nút đăng ký
    public function register(Request $request)
    {
        if (empty($request->email) || empty($request->password)) {
            return back()->withInput()->with('error', 'Email và mật khẩu không được để trống');
        }
        if ($request->password != $request->confirm_password) {
            return back()->withInput()->with('error', 'Mật khẩu và xác nhận mật khẩu không khớp');
        }

        if (empty($request->name) || empty($request->phone) || empty($request->address)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withInput()->with('error', 'Email không đúng định dạng');
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
        $userId = -1;
        Cart::where('user_id', $userId)->update(['user_id' => $user->id]);
        Cart::where('user_id', -1)->delete();
        return redirect('/');
    }

    // Trang cập nhật thông tin cá nhân
    public function updateProfileView()
    {
        $user = Session::get('user_info', null);
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('update_profile', compact('user', 'carts'));
    }

    // Cập nhật thông tin cá nhân -> khi nhận nút cập nhật thông tin
    public function updateProfile(Request $request)
    {
        if (empty($request->email)) {
            return back()->withInput()->with('error', 'Email không tồn tại');
        }


        if (empty($request->name)) {
            return back()->withInput()->with('error', 'Vui lòng điền đầy đủ thông tin');
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->withInput()->with('error', 'Email không đúng định dạng');
        }

        if ($request->old_password && $request->password && $request->password != $request->confirm_password) {
            return back()->withInput()->with('error', 'Mật khẩu và xác nhận mật khẩu không khớp');
        }

        $user = User::where('email', $request->email)->first();
        if ($request->old_password && Hash::check($request->old_password, $user->password)) {
            return back()->withInput()->with('error', 'Mật khẩu cũ không chính xác');
        }

        if ($request->old_password && $request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->name) {
            $user->name = $request->name;
        }

        if ($request->phone) {
            $user->phone = $request->phone;
        }

        if ($request->address) {
            $user->address = $request->address;
        }

        $user->save();
        Session::put('user_info', $user);
        return redirect('/');
    }


    // Xử lý đăng xuất
    public function logout() {
        Session::put('user_logged', false);
        Session::put('user_info', null);
        return redirect('/');
    }

    // Tạo bình luận -> khi nhấn nút gửi đi
    public function comment(Request $request)
    {
        if (empty($request->comment)) {
            return back()->withInput()->with('error', 'Vui lòng nhập bình luộn');
        }
        $comment = new Comment();
        $comment->id_product = $request->product_id;
        $comment->id_user = $request->user_id;
        $comment->user_name = $request->user_name;
        $comment->content = $request->comment;
        $comment->save();

        return redirect()->back();
    }

    // Trang tin tức
    public function news()
    {
        $news = News::paginate(4);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
                $product = DB::table('products')
                    ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                    ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                    ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                    ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                    ->where('products.id', $value->product_id)
                    ->first();
                switch ($product->sale_type_id) {
                    case 1:
                        $product->sale = $product->sale_value.'%';
                        $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                        break;
                    case 2:
                        $product->sale = number_format($product->sale_value, 0).'đ';
                        $product->sale_price = $product->price - $product->sale_value;
                        break;
                    default:
                        break;
                }
                $product->price = $product->sale_price ?? $product->price;
                $value->product = $product;
            }

        return view('news', compact('news','categories', 'carts'));
    }

    // Trang chi tiết tin tức
    public function newsDetail(Request $request, $id)
    {
        $news = News::find($id);
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('newsDetail', compact('news', 'categories', 'carts'));
    }

    // Trang Danh sách đơn hàng
    public function orders()
    {
        if (Session::get('user_logged') !== true) {
            return redirect('/');
        }
        $user = Session::get('user_info');
        $orders = Order::where('id_user', $user->id)->orderBy('created_at', 'DESC')->paginate(6);
        foreach($orders as $key => $order) {
            $orders[$key]->status_text = Order::getStatusNameAttribute($order->status);
            $orders[$key]->status_class = Order::getStatusClassNameAttribute($order->status);
        }
        $categories = Category::getParent();
        foreach ($categories as $menu) {
            $menu->subCat = Category::getCategoryChild($menu->id);
        }
        $user = Session::get('user_info');
        $carts = Cart::where('user_id', $user->id)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('orders', compact('orders', 'categories', 'carts'));
    }


    // Trang chi tiết đơn hàng
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
        $user = Session::get('user_info');
        $carts = Cart::where('user_id', $user->id)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }

        return view('order_detail', compact('order_details', 'order_id', 'categories', 'carts'));
    }


    //Xử lý hủy đơn hàng
    public function cancelOrder(Request $request) {
        $data = [
            'status' => 1
        ];
        $order = Order::where('id', $request->id);
        $orderDetails = OrderDetail::where('id_order', $request->id)->get();
        foreach ($orderDetails as $key => $detail) {
            $quantity = $detail->quantity;
            $product = Product::where('id', $detail->id_product)->first();
            $productQuantity = $product->quantity;
            $newQuantity = $productQuantity + $quantity;
            $product->update(['quantity' => $newQuantity]);
        }
        $order->update($data);

        return redirect()->route('user.orders');
    }

    // Trang tìm kiếm
    public function search(Request $request) {

        $keyword = $request->keyword;
        $products = DB::table('products')
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
            ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
            ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            ->where('products.name', 'like', "%$keyword%")->get();
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
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('search', compact('products', 'categories', 'keyword', 'carts'));
    }

    // Trang hướng dẫn mua hàng
    public function guide(Request $request)
    {
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('guide', compact('carts'));
    }

    // Trang sản phẩm bán chạy
    public function bestseller(Request $request)
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
            ->select('products.*', 'sale.value as sale_value', 'sale_type_id')
            ->join('order_details', 'order_details.id_product', 'products.id')
            ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
            ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
            ->whereMonth('order_details.created_at', '=', $month)
            ->whereYear('order_details.created_at', '=', $year)
            ->groupBy('order_details.id_product')->orderByRaw('SUM(order_details.quantity) DESC')->limit(48)->paginate(16);
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
        $user = Session::get('user_info');
        $userId = -1;
        if ($user) {
            $userId = $user->id;
        }
        $carts = [];
        $carts = Cart::where('user_id', $userId)->get();
        foreach ($carts as $value) {
            $product = DB::table('products')
                ->select('products.*', 'sale.value as sale_value', 'sale_type_id', 'categories.name as category_name')
                ->leftJoin('sale', 'sale.id', '=', 'products.sale_id')
                ->leftJoin('sale_type', 'sale.sale_type_id', '=', 'sale_type.id')
                ->leftJoin('categories', 'categories.id', '=', 'products.id_category')
                ->where('products.id', $value->product_id)
                ->first();
            switch ($product->sale_type_id) {
                case 1:
                    $product->sale = $product->sale_value.'%';
                    $product->sale_price = $product->price - $product->price * $product->sale_value / 100;
                    break;
                case 2:
                    $product->sale = number_format($product->sale_value, 0).'đ';
                    $product->sale_price = $product->price - $product->sale_value;
                    break;
                default:
                    break;
            }
            $product->price = $product->sale_price ?? $product->price;
            $value->product = $product;
        }
        return view('bestseller', compact('products', 'categories', 'carts'));
    }
}
