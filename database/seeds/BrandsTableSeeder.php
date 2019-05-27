<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
        	'Uniqmed',
        	'GR',
        	'Descarpack',
        	'Testline',
        	'Footcare Vital Safe',
        	'NT Flex',
        	'Dr Luvas',
        	'Missner',
        	'Oftam',
        ];

        foreach($brands as $brand) {
        	$b = new Brand;
        	$b->name = $brand;
        	$b->save();
        }
    }
}
