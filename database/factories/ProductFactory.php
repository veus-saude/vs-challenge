<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' =>  strtoupper($faker->word()),
        'brand' => strtoupper($faker->company()),
        'price' => $faker->randomFloat(2, 0, 300),
        'amount' => $faker->numberBetween(1, 999),
    ];
});
