<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'produto' => 100,
            'nome' => 'seringa',
            'marca' => 'ABC',
            'preco' => '1000.00',
            'quantidade' => '15'
        ]);
        DB::table('produtos')->insert([
            'produto' => 110,
            'nome' => 'seringa',
            'marca' => 'XYZ',
            'preco' => '1000.00',
            'quantidade' => '15'
        ]);
        DB::table('produtos')->insert([
            'produto' => 120,
            'nome' => 'seringa',
            'marca' => 'FFF',
            'preco' => '1000.00',
            'quantidade' => '15'
        ]);
        DB::table('produtos')->insert([
            'produto' => 200,
            'nome' => 'medicacao',
            'marca' => 'XYZ',
            'preco' => '550.70',
            'quantidade' => '48'
        ]);
        DB::table('produtos')->insert([
            'produto' => 210,
            'nome' => 'medicacao',
            'marca' => 'FFF',
            'preco' => '678.97',
            'quantidade' => '5'
        ]);
        DB::table('produtos')->insert([
            'produto' => 220,
            'nome' => 'medicacao',
            'marca' => 'ABC',
            'preco' => '678.97',
            'quantidade' => '5'
        ]);
    }
}
