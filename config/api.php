<?php

return [

    'versions' => [
        'v1'
    ],

    'contracts' => [
        \App\Repositories\ProductRepositoryContract::class
    ],

    'bindings' => [

        'v1' => [
            \App\Repositories\ProductRepositoryContract::class => App\Repositories\V1\ProductRepository::class
        ],

    ]

];
