<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Session\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('app', function($view) {
        //     $cart = [];
        //     if (Session('cart')) {
        //         $oldCart = Session::get('cart');
        //         $cart = $oldCart;
        //     }
        //     $view()->with(['cart' => $cart]);
        // });
    }
}
