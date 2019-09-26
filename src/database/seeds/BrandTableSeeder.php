<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')->insert(['name' => 'BUNZL']);
        DB::table('brand')->insert(['name' => 'TYLENOL']);
        DB::table('brand')->insert(['name' => 'AMOXIL']);
        DB::table('brand')->insert(['name' => 'NEOSPORIN']);
    }
}
