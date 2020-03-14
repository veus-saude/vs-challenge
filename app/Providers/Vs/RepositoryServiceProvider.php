<?php

namespace app\Providers\Vs;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
        'Model\Brand\BrandRepositoryInterface',
        'Model\Brand\BrandRepository'
        );

        $this->app->bind(
            'Model\Product\ProductRepositoryInterface',
            'Model\Product\ProductRepository'
        );

        $this->app->bind(
            'Model\User\UserRepositoryInterface',
            'Model\User\UserRepository'
        );
    }
}
