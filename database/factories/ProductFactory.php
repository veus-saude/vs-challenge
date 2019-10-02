<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'sku' => $faker->uuid,
        'brand' => $faker->randomElement(['BUNZL', 'ACCTRN', 'PPLNL']),
    ];
});
