<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Product as Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,100) as $index) {
	        Product::insert([
                'name' => $faker->name,
                'brand' => $faker->sentence,
                'price' => $faker->numberBetween(0, 1000),
                'quantity' => $faker->numberBetween(0, 1000),        
	        ]);
	    }
    }
}