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
        DB::table('products')->insert([
            [
                'name'=> 'Seringa 1 mL Insulina c/ Agulha 6,0x0,25mm Pct 10unds' ,
                'brand'=> 'Uniqmed' ,
                'price'=> 20.90 ,
                'stock'=> 15
            ],[
                'name'=>'FRALDA GERIÁTRICA ADULTO',
                'brand'=>'Descarpack',
                'price'=> 14.50,
                'stock'=> 10
            ],[
                'name'=>'Bolsa de Gelo',
                'brand'=>'Uniqmed',
                'price'=> 35.90,
                'stock'=> 3
            ],[
                'name'=>'Seringa Sem Agulha 60ml Bico Cateter',
                'brand'=>'DB',
                'price'=> 15.50,
                'stock'=> 15
            ],[
                'name'=> 'Coletor Plástico Quimioterápico 7 Litros',
                'brand'=> 'Descarpack',
                'price'=> 27.90,
                'stock'=> 12
            ],[
                'name'=> 'Touca Descartável Sanfonada TNT',
                'brand'=> 'Descarpack',
                'price'=> 8.45,
                'stock'=> 10
            ]
        ]);
    }
}
