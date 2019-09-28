<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Product;
use Faker\Generator as Faker;


$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'price'         => $faker->randomFloat(2, 0,8),
        'brand'         => $faker->name,
        'quantity'    => $faker->numberBetween(1,100)
    ];
});
