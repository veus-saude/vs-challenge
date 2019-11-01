<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $faker = \Faker\Factory::create();
        for($i = 0; $i < 50; $i++){
            Product::created([
                'name' => $faker->name,
                'brand' => $faker->company,
                'price' => $faker->randomFloat(2,10),
                'stock' => $faker->randomNumber(3)
            ]);
        }
    }
}
