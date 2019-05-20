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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => $password ?: $password = app('hash')->make('123456'),
    ];
});
$factory->define(App\Models\Brand::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(\App\Models\Product::class,function(\Faker\Generator $faker){
    return [
        'name' => $faker->colorName,
        'value' => $faker->numerify('###.##'),
        'quantity' => $faker->numerify('##')
    ];
});
