<?php

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class BrandProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'APPLE',
            'MICROSOFT',
            'BUNZL',
            'SAMSUNG',
            'LG',
        ];
        for ($i=0; $i < 5; $i++) { 
            $b = Brand::create([
                'name' => $brands[$i],
            ]);
            factory(Product::class, 100)->create()->each(function($p) use($b) {
                $b->products()->save($p);
            });
        }
    }
}
