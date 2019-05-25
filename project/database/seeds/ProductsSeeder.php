<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductsSeeder. 
 */
class ProductsSeeder extends Seeder 
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
	public function run() : void
	{
		$rawData = [
			[
				'sku' => '37540',
				'name' => 'Seringa Bd Sem agulha Becton 10ml',
				'brand' => 'Becton',
				'price' => 3.55,
				'stock' => 100
			],
			[
				'sku' => '37397',
				'name' => 'Agulha Bd Becton 25x7 com 1 Unidade',
				'brand' => 'Becton',
				'price' => 0.45,
				'stock' => 100
			],
			[
				'sku' => '37650',
				'name' => 'Seringa Bd Solomed com Agulha 25x0,7 Becton 3ml',
				'brand' => 'Becton',
				'price' => 1.85,
				'stock' => 100
			],
			[
				'sku' => '86525',
				'name' => 'Agulha BD 20x0,55 Becton - 1 unidade',
				'brand' => 'Becton',
				'price' => 1.69,
				'stock' => 100
			],
			[
				'sku' => '37613',
				'name' => 'Seringa Bd Solomed com Agulha 30x0,7 Becton 3ml',
				'brand' => 'Becton',
				'price' => 1.85,
				'stock' => 100
			],
		];

		DB::table('products')->insert($rawData);
	}
}