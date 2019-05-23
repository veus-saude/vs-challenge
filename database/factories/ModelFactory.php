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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Source\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
    ];
});

$factory->define(\App\Source\Brands::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(\App\Source\Produtcs::class, function (Faker\Generator $faker) {
    $brand = \App\Source\Brands::select('id')->inRandomOrder()->first();
    $type = \App\Source\Types::select('id')->inRandomOrder()->first();
    return [
        'id_brand' => $brand->getId(),
        'id_type' => $type->getId(),
        'name' => $faker->name,
    ];
});