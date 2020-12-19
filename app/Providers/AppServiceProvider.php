<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        ini_set('memory_limit', '-1');

        \Carbon\Carbon::setLocale('pt_BR');

        Schema::defaultStringLength(191);

        if(env('APP_ENV')=='production')
        {
            \URL::forceScheme('https');
        }
    }
}
