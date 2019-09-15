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
    });
});
