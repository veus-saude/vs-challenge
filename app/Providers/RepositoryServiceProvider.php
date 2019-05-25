<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $contracts = config("api.contracts");

        $bindings = config('api.bindings');

        foreach($contracts as $contract) {

            $this->app->bind($contract, function($app) use ($contract, $bindings) {

                $version = Request::segment(2);

                return $app[$bindings[$version][$contract]];
            });
        }
    }
}
