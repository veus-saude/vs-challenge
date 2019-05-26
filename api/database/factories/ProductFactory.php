<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'brand' => $faker->company,
        'price' => 10.0,
        'amount' => 50,
    ];
});
