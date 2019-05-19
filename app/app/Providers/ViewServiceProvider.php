<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('partials.cb_brandById', 'App\Http\ViewComposers\BrandComposer');
        view()->composer('partials.cb_brandByName', 'App\Http\ViewComposers\BrandComposer');
    }
}
