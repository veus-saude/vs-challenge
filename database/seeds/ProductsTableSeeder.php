<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
        	// UNIQMED
        	[
        		'name' 		=>	'SERINGA 1,0 ML COM AGULHA 8,0X0,30MM. PACOTE COM 10 UNIDADES',
        		'brand_id' 	=>	1,
        		'price'		=>	1999,
        		'quantity'	=>	20,
        	] ,[
        		'name' 		=>	'LÂMINA DE BISTURI N. 21 CX C/ 100 UNDS',
        		'brand_id' 	=>	1,
        		'price'		=>	4185,
        		'quantity'	=>	30,
        	] ,[
        		'name' 		=>	'Agulha Para Acupuntura 0,25 x 30mm',
        		'brand_id' 	=>	1,
        		'price'		=>	3690,
        		'quantity'	=>	0,
        	] ,[
        		'name' 		=>	'Agulha para Caneta de Insulina 5mm',
        		'brand_id' 	=>	1,
        		'price'		=>	5499,
        		'quantity'	=>	1,
        	],
        	// SR
        	[
        		'name' 		=>	'SERINGA 1 ML COM AGULHA 6,0X0,25MM PCT C/ 10 UNDS',
        		'brand_id' 	=>	 2,
        		'price'		=> 	1099,
        		'quantity'	=>	45,
        	], [
        		'name' 		=>	'Seringa 3 ml Luer Lok Caixa com 500 Unidades',
        		'brand_id' 	=>	 2,
        		'price'		=> 	9500,
        		'quantity'	=>	17,
        	], [
        		'name' 		=>	'Seringa 10 ml Luer Lok Caixa com 250 Unidades',
        		'brand_id' 	=>	 2,
        		'price'		=> 	10425,
        		'quantity'	=>	12,
        	], [
        		'name' 		=>	'SERINGA 5 ML COM AGULHA 25X7 CX C/ 500 UNDS',
        		'brand_id' 	=>	 2,
        		'price'		=> 	17200,
        		'quantity'	=>	5,
        	],
        	// DESCARPACK
        	[
        		'name' 		=>	'Luva de Procedimento Nitrilica Preta Sem Talco Cx c/ 20 cxs',
        		'brand_id' 	=>	3,
        		'price'		=> 	45980,
        		'quantity'	=>	10,
        	], [
        		'name' 		=>	'Caixa Coletora Descarpack 3 Litros',
        		'brand_id' 	=>	3,
        		'price'		=> 	415,
        		'quantity'	=>	100,
        	], [
        		'name' 		=>	'Catéter Intravenoso Cx c/ 100 unds',
        		'brand_id' 	=>	3,
        		'price'		=> 	11490,
        		'quantity'	=>	76,
        	], [
        		'name' 		=>	'Luva Plastica Estéril',
        		'brand_id' 	=>	3,
        		'price'		=> 	1399,
        		'quantity'	=>	80,
        	],
        	// TESTLINE
        	[
        		'name' 		=>	'Tiras de Glicose',
        		'brand_id' 	=>	4,
        		'price'		=> 	5999,
        		'quantity'	=>	27,
        	], [
        		'name' 		=>	'Agulha para Caneta de Insulina TESTFINE 8mm',
        		'brand_id' 	=>	4,
        		'price'		=> 	5499,
        		'quantity'	=>	40,
        	], [
        		'name' 		=>	'Agulha para Caneta de Insulina TESTFINE 13mm',
        		'brand_id' 	=>	4,
        		'price'		=> 	3990,
        		'quantity'	=>	22,
        	], [
        		'name' 		=>	'Agulha para Caneta de Insulina UNIFINE 6mm',
        		'brand_id' 	=>	4,
        		'price'		=> 	5499,
        		'quantity'	=>	28,
        	], 
        	// FOOTCARE VITAL SAFE
        	[
        		'name' 		=>	'Protetores em gel',
        		'brand_id' 	=>	5,
        		'price'		=> 	1999,
        		'quantity'	=>	13,
        	], [
        		'name' 		=>	'Palmilha Siligel Tamanho 38-39',
        		'brand_id' 	=>	5,
        		'price'		=> 	5449,
        		'quantity'	=>	18,
        	], [
        		'name' 		=>	'Calcanheira Siligel Feminina',
        		'brand_id' 	=>	5,
        		'price'		=> 	2875,
        		'quantity'	=>	10,
        	], [
        		'name' 		=>	'Protetor de Espuma para calos',
        		'brand_id' 	=>	5,
        		'price'		=> 	915,
        		'quantity'	=>	15,
        	],
        	// NT FLEX
        	[
        		'name' 		=>	'Saboneteira Líquida Pump 500 mL',
        		'brand_id' 	=>	6,
        		'price'		=> 	695,
        		'quantity'	=>	30,
        	], [
        		'name' 		=>	'Touca Banho Cristal',
        		'brand_id' 	=>	6,
        		'price'		=> 	350,
        		'quantity'	=>	120,
        	], [
        		'name' 		=>	'Lixa Para Unhas Zebra Premium',
        		'brand_id' 	=>	6,
        		'price'		=> 	530,
        		'quantity'	=>	80,
        	], [
        		'name' 		=>	'Kit de Manicure Cx c/ 20 Kits',
        		'brand_id' 	=>	6,
        		'price'		=> 	2980,
        		'quantity'	=>	50,
        	],
        	// DR LUVAS
        	[
        		'name' 		=>	'Papel Grau Cirurgico Todos os Tamanhos',
        		'brand_id' 	=>	7,
        		'price'		=> 	4215,
        		'quantity'	=>	7,
        	], [
        		'name' 		=>	'Luva de Látex Black',
        		'brand_id' 	=>	7,
        		'price'		=> 	1999,
        		'quantity'	=>	9,
        	], [
        		'name' 		=>	'Touca Descartável Sanfonada TNT Verde',
        		'brand_id' 	=>	7,
        		'price'		=> 	1199,
        		'quantity'	=>	29,
        	], [
        		'name' 		=>	'Luva Descartável Plástica',
        		'brand_id' 	=>	7,
        		'price'		=> 	225,
        		'quantity'	=>	200,
        	],
        	// MISSNER
        	[
        		'name' 		=>	'Fita Microporosa Bege 10cm x 10m',
        		'brand_id' 	=>	8,
        		'price'		=> 	1320,
        		'quantity'	=>	40,
        	], [
        		'name' 		=>	'Fita Microporosa Bege 5cm x 10m',
        		'brand_id' 	=>	8,
        		'price'		=> 	840,
        		'quantity'	=>	25,
        	], [
        		'name' 		=>	'Curativo Flexível Neon Cx c/ 15 Unds',
        		'brand_id' 	=>	8,
        		'price'		=> 	450,
        		'quantity'	=>	35,
        	], [
        		'name' 		=>	'Curativo Flexível Safari Cx c/ 15 Unds',
        		'brand_id' 	=>	8,
        		'price'		=> 	450,
        		'quantity'	=>	38,
        	], 
        	// OFTAM
        	[
        		'name' 		=>	'Protetor Ocular Divertido Feminino Tamanho Pequeno',
        		'brand_id' 	=>	9,
        		'price'		=> 	2699,
        		'quantity'	=>	30,
        	], [
        		'name' 		=>	'Protetor Ocular Divertido Masculino Tamanho Pequeno',
        		'brand_id' 	=>	9,
        		'price'		=> 	2699,
        		'quantity'	=>	30,
        	], [
        		'name' 		=>	'Protetor Ocular Piratinha Colorido Tamanho Pequeno',
        		'brand_id' 	=>	9,
        		'price'		=> 	1985,
        		'quantity'	=>	20,
        	], [
        		'name' 		=>	'Protetor Ocular Bege Tamanho Pequeno',
        		'brand_id' 	=>	9,
        		'price'		=> 	1190,
        		'quantity'	=>	0,
        	],
        ];

        foreach($products as $p) {
        	$product = new Product;

        	foreach ($p as $key => $value) {
        		$product[$key] = $value;
        	}
        	$product->save();
        }
    }
}
