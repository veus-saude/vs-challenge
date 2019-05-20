<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = app(\App\Repositories\BrandRepository::class);
        $brand->create([
            'name' => 'BUNZL'
        ]);
        factory(\App\Models\Brand::class,10)
            ->create()->each(function($brand){
                $brand->save();
            });
    }
}
