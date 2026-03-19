<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $customer = Auth::guard('customer')->user();

            if ($customer) {
                $cart = Cart::where('customers_id', $customer->id)->count();
            } else {
                $cart = 0;
            }

            $view->with('cartCount', $cart);
        });
    }
}
