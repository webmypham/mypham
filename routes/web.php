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

Route::get('/', 'HomeController@index');

Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin'
], function () {
    // login
    Route::get('login','LoginController@getLogin')->name('getLogin');
	Route::get('logout','LoginController@getLogout')->name('getLogout');
    Route::post('login','LoginController@postLogin')->name('postLogin');

    Route::middleware(['check.loginAdmin'])->group(function () {
        // products
        Route::resource('products', 'ProductController');

        // categories
        Route::resource('categories', 'CategoryController');

        // orders
        Route::resource('orders', 'OrderController');

        // news
        Route::resource('news', 'NewsController');

        // users
        Route::resource('users', 'UserController');

        // comments
        Route::resource('comments', 'CommentController');

        // receipt
        Route::resource('receipts', 'ReceiptController');

        //slide
        Route::resource('slides', 'SlideController');
    });
});

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

