<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder {

    public function run()
    {
		factory(App\Brand::class, 10)
			->create();
    }

}