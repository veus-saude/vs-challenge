<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Product;
use Faker\Generator as Faker;


$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'          => $faker->name,
        'price'         => $faker->randomFloat(3, 0,8),
        'amount'        => $faker->numberBetween(1,10),
        'brand'         => $faker->name,
    ];
});
