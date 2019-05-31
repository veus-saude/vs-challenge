<?php

use Illuminate\Database\Seeder;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            ['name' => 'desinfetante hospitalar scotch brite flex 2l 5a', 'code' => '130001', 'brand' => 'BUNZL', 'measure' => '2L', 'details' => 'Diluição 1L > 240LO rendimento total da bombona é de 480L']
        );
        DB::table('products')->insert(
            ['name' => 'DESINFETANTE SB FLEX LAVANDA 2L 5A', 'code' => '130057', 'brand' => 'BUNZL', 'measure' => '2L', 'details' => 'Bombona de 2 litros faz 480 litros de produto pronto uso']
        );
        DB::table('products')->insert(
            ['name' => 'DESINFETANTE LIMPADOR CLORADO SB FLEX 2L 38B', 'code' => '130062', 'brand' => 'BUNZL', 'measure' => '2L', 'details' => 'Diluição 1L ►40L. O rendimento total da bombona é de 80L']
        );
        DB::table('products')->insert(
            ['name' => 'LIMPA VIDROS  SCOTCH BRITE FLEX 1B 2L', 'code' => '440004', 'brand' => 'BUNZL', 'measure' => '2L', 'details' => 'Diluição 1L > 56L.Rendimento total da bombona é de 112L.']
        );
        DB::table('products')->insert(
            ['name' => 'DETERGENTE BATUTA  NEUTRO 5L', 'code' => '400074', 'brand' => 'BUNZL', 'measure' => '5L', 'details' => 'Diluição 1:10 a 1:60. Faz até 300 litros']
        );
        DB::table('products')->insert(
            ['name' => 'DISPENSER BOBINA AUTO CORTE Com  SENSOR', 'code' => '190066', 'brand' => 'BUNZL', 'measure' => 'UN', 'details' => 'A: 36,8cm L: 33,1cm, C: 20,6cm']
        );
        DB::table('products')->insert(
            ['name' => 'PAPEL TOALHA BOBINA ADV f OLHA SIMPLES', 'code' => '550024', 'brand' => 'BUNZL', 'measure' => 'CX', 'details' => 'Caixa c/ 6 rolos']
        );
        DB::table('products')->insert(
            ['name' => 'DISPENSER HIGIÊNICO SMARTONE MINI BRANCO', 'code' => '180077', 'brand' => 'BUNZL', 'measure' => 'UN', 'details' => 'A: 21,9cm L: 21,9cm C: 15,6cm']
        );
        DB::table('products')->insert(
            ['name' => 'SABONETEIRA BRANCA Para REFIL ESPUMA manual', 'code' => '210054', 'brand' => 'BUNZL', 'measure' => 'UN', 'details' => 'A: 12cm, L: 12cm, C: 30cm']
        );
    }
}
