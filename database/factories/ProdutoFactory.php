<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Produto;
use Faker\Generator as Faker;


$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome'          => $faker->name,
        'preco'         => $faker->randomFloat(2, 0,8),
        'marca'         => $faker->name,
        'quantidade'    => $faker->numberBetween(1,100)
    ];
});
