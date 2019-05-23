<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Source\Brands::class, 1)->create([
            'name' => 'BUNZL'
        ]);
        factory(\App\Source\Brands::class, 20)->create();
    }
}
