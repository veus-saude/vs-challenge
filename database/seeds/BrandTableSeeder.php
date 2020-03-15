<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brand')->delete();
        
        \DB::table('brand')->insert(array (
            0 => 
            array (
                'brand_id' => 1,
                'name' => 'Procarre',
            ),
            1 => 
            array (
                'brand_id' => 3,
                'name' => 'Procare',
            ),
            2 => 
            array (
                'brand_id' => 4,
                'name' => 'Plumax',
            ),
            3 => 
            array (
                'brand_id' => 5,
                'name' => 'Solidor',
            ),
            4 => 
            array (
                'brand_id' => 6,
                'name' => 'Labor',
            ),
            5 => 
            array (
                'brand_id' => 7,
                'name' => 'HistoPot',
            ),
            6 => 
            array (
                'brand_id' => 8,
                'name' => 'Stra Medical',
            ),
            7 => 
            array (
                'brand_id' => 9,
                'name' => 'Ecologic',
            ),
        ));
        
        
    }
}