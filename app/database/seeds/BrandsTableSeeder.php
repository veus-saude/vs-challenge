<?php

use Illuminate\Database\Seeder;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('brands')->delete();

        DB::table('brands')->insert([
            'name' => 'BUNZL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        factory(Brand::class, 5)->create();

        
    }
}
