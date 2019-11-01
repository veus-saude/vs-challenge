<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $faker = Faker\Factory::create();
        for($i = 0; $i < 50; $i++){
            Product::create([
                'name' => $faker->name,
                'brand' => $faker->company,
                'price' => 100+$i,
                'stock' => $faker->randomNumber(3)
            ]);
        }
    }
}
