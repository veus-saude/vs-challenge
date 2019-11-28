<?php

use Illuminate\Database\Seeder;
use App\Models\Api\v1\Brand;
use Illuminate\Support\Str;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $endings = [
            ' Coorporation',
            ' LTDA',
            ' ME',
            ' EIRELI',
            ' S.A.'
        ];
        
        for ($i = 1; $i <= 20; $i++) {
        
            $choosen = array_rand($endings);

            Brand::create([
                'name' => Str::random(10) . $endings[$choosen]
            ]);
            
        }
    }
}
