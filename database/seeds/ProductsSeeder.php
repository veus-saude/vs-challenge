<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
    	foreach (range(1,20) as $index) {
	        DB::table('products')->insert([
                'name' => $faker->name,
                'brand' => $faker->sentence,
                'price' => $faker->numberBetween(0, 700),
                'quantity' => $faker->numberBetween(0, 700),        
	        ]);
	    }
    }
}
