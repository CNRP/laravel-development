<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        config(['app.timezone' => env('APP_TIMEZONE', 'Europe/London')]);

        Blade::if('productInBasket', function ($product) {
            return app('App\Http\Controllers\BasketController')->checkProductInBasket($product);
        });

        View::composer('*', function ($view) {
            $basketItems = session()->get('basket', []);
            $totalItems = collect($basketItems)->sum('quantity');

            $view->with('totalItems', $totalItems);
        });
    }
}
