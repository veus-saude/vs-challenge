<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'brand' => $faker->word,
        'price' => $faker->randomFloat(2, 0, 1000),
        'stock' => $faker->numberBetween(0, 1000),
    ];
});
