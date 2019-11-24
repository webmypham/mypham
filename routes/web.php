<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
Route::get là phương thức get Route::post là phương thức post, tham số đâu tiên là url, tham số thứ 2 trước dấu @ là tên controller, sau dấu @ là tên function
 * Ví dụ: Route::get('/home', 'HomeController@index');
 * Sẽ khai báo url là '/home gọi controller HomeController và gọi hàm index
 *
 * Route::group([
'namespace' => 'Admin',
'prefix' => 'admin'
])
 *
 * group sẽ gom nhóm các route lại
 * namespace là namespace của controller ví dụ namespace là admin thì sẽ lấy các controller trong thư mục admin
 * prefix là tiền tố của url ví dụ prefix là admin thì url 'products' sẽ là 'admin/product'
 *
 *  Route::get('login','LoginController@getLogin')->name('getLogin');
 * ->name(
 */

Route::get('/', 'HomeController@index');
Route::get('/home', function () {
   return redirect('/admin/products');
});
// Route của admin
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    // login
    //khai báo urlurl
    Route::get('login','LoginController@getLogin')->name('getLogin');
	Route::get('logout','LoginController@getLogout')->name('getLogout');
    Route::post('login','LoginController@postLogin')->name('postLogin');

    //middleware là 1 lớp bao ngoài controller, sẽ được thực thi trước controller
    Route::middleware(['check.loginAdmin'])->group(function () {
        // products
        /**Khai báo định tuyến duy nhất này tạo ra nhiều định tuyến để xử lý đa dạng các loại hành động RESTful
         * cho tài nguyên "photo".Tương tự như vậy, controller được tạo ra sẽ có sẵn vài method gốc rễ cho từng hành động,
         * bao gồm cả ghi chú thông báo cho bạn những URI và những HTTP method (POST, GET, PUT, PATCH, DELETE) nào chúng xử lý. */
        Route::resource('products', 'ProductController');

        // categories
        Route::resource('categories', 'CategoryController');

        // orders
        Route::resource('orders', 'OrderController');

        // news
        Route::resource('news', 'NewsController');

        Route::get('statistic', 'StatisticController@index')->name('admin.statistic');
        Route::resource('sale', 'SaleController');
        // news
        Route::resource('users', 'UserController');

        // comments
        Route::resource('comments', 'CommentController');

        // receipt
        Route::resource('receipts', 'ReceiptController');

        //slide
        Route::resource('slides', 'SlideController');

        Route::get('bestseller', 'StatisticController@bestSeller')->name('admin.bestseller');
        Route::get('print-bill', 'OrderController@printBill')->name('printBill');
    });
});

// route của khách hàng
Route::get('news', 'HomeController@news')->name('user.news');
Route::get('news/{id}', 'HomeController@newsDetail')->name('user.newsDetail');

Route::get('add-to-cart', 'HomeController@addProductToCart')->name('addToCart');
Route::get('remove-from-cart', 'HomeController@removeProductFromCart')->name('removeFromCart');
Route::get('update-cart', 'HomeController@updateCart')->name('updateCart');

Route::get('cart', 'HomeController@cart')->name('cart');
Route::get('checkout', 'HomeController@checkout')->name('checkout');
Route::post('cart/create', 'HomeController@createOrder')->name('save_order');
Route::get('order/detail/{id}', 'HomeController@order')->name('order');
Route::get('get-cart-count', 'HomeController@getCartCount')->name('cartCount');

Route::get('register', 'HomeController@registerView')->name('register');
Route::post('register', 'HomeController@register')->name('user.register');
Route::get('update-profile', 'HomeController@updateProfileView')->name('user.updateProfileView');
Route::post('update-profile', 'HomeController@updateProfile')->name('user.updateProfile');
Route::get('login', 'HomeController@login')->name('login');
Route::post('login', 'HomeController@checkLogin')->name('user.login');
Route::get('logout', 'HomeController@logout')->name('user.logout');

Route::post('comment', 'HomeController@comment')->name('user.comment');

Route::get('orders', 'HomeController@orders')->name('user.orders');
Route::get('order/{id}', 'HomeController@orderDetail')->name('user.orderDetail');
Route::post('cancel-order', 'HomeController@cancelOrder')->name('user.cancelOrder');


Route::get('{slug}/{id}', 'HomeController@category')->name('category');
Route::get('san-pham/{slug}/{id}', 'HomeController@product')->name('product');

Route::get('search', 'HomeController@search')->name('search');
Route::get('guide', 'HomeController@guide')->name('user.guide');
Route::get('bestseller', 'HomeController@bestseller')->name('user.bestseller');

