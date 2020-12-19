<?php

use Illuminate\Database\Seeder;

class ProdutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            ['id' => 1, 'nome' => 'Atenolol 25mg'],
            ['id' => 2, 'nome' => 'Losartana Potássica 50mg'],
            ['id' => 3, 'nome' => 'Sinvastatina 20mg']
        ]);
    }
}
