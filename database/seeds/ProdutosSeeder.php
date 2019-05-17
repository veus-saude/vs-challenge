<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Produto;

class ProdutosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $faker = Faker::create();
        
        foreach (range(1, 200) as $index) {
            Produto::create([
               "name" => $faker->word,
               "brand" => $faker->word,
               "value" => $faker->randomFloat(2, 1, 1000),
               "stock" => $faker->randomNumber(2)
            ]);
        }
    }

}
