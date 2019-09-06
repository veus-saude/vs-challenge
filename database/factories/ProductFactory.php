<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand' => $faker->company,
        'price' => $faker->randomDigit,
        'quantity' => $faker->randomNumber
    ];
});
