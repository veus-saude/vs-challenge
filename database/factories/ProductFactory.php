<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand' => $faker->sentence,
        'price' => $faker->numberBetween(0, 1000),
        'quantity' => $faker->numberBetween(0, 1000),
    ];
});
