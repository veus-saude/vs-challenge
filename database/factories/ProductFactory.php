<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'brand' => $faker->randomElement([
            'BUNZL', 'KOXNI', 'LAXJE', 'REPKXU', 'AXHYE'
        ]),
        'description' => $faker->company,
        'price' => $faker->randomFloat(2, 0, 9999.99),
        'thumbnail' => $faker->imageUrl(),
        'quantity' => random_int(0, 20)
    ];
});
