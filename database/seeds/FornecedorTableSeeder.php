<?php

use Illuminate\Database\Seeder;

class FornecedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fornecedor')->insert([
          ['id' => 1, 'nome' => 'Biosintética'],
          ['id' => 2, 'nome' => 'EMS'],
          ['id' => 3, 'nome' => 'Geolab'],
          ['id' => 4, 'nome' => 'Germed'],
          ['id' => 5, 'nome' => 'Multilab'],
          ['id' => 6, 'nome' => 'Neo Química'],
          ['id' => 7, 'nome' => 'Prati'],
          ['id' => 8, 'nome' => 'Sandoz'],
          ['id' => 9, 'nome' => 'Teuto']
        ]);
    }
}
