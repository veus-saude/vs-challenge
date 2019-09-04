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
        Schema::defaultStringLength(191);
    }

    public function boot()
    {
        /**
         * Um exemplo que uso nos meus projetos
         * -----------------------------------------------------------------------
         * \App\Models\Customer::observe(\App\Observers\CustomerObserver::class);
         * -----------------------------------------------------------------------
         */
    }
}
