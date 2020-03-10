<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    
    return [
        'name' => $faker->colorName,
        'brand' => $faker->word,
        'price' => $faker->numberBetween(1000, 20000),
        'quantity' => $faker->numberBetween(1, 100),
        'created_at' => $faker->dateTimeThisMonth()
    ];
});
