<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(array('Seringa', 'Atadura', 'Esparadrapo', 'Iodo', 'Alcool', 'Analgesico', 'Antitermico', 'Suplemento', 'Anticoncepcional', 'Termometro', 'Antigripal', 'Diuretico')),
        'brand' => $faker->randomElement(array('AbbVie', 'Pfizer', 'Celgene', 'Bristol-Myers Squibb', 'Merck & Co.', 'Amgen', 'Roche', 'Biogen', 'Bayer', 'Johnson & Johnson', 'Regeneron Pharmaceuticals', 'Janssen Biotech', 'Bunzl')),
		'price' => $faker->randomFloat(2, 1, 200),
		'amount' => $faker->numberBetween(0, 999)
    ];
});
