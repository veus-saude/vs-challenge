<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * @var \App\Services\ProductService
     */
    private $productService;

    /**
     * ProductSeeder constructor.
     * @param \App\Services\ProductService $productService
     */
    public function __construct(\App\Services\ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->productService->create([
            'name' => 'Protetor Solar - Sun 30 FPS',
            'brand_id' => 6,
            'price' => 57.9,
            'qty'   => 20
        ]);

        $this->productService->create([
            'name' => 'Aciclovir - Comprimidos',
            'brand_id' => 1,
            'price' => 38,
            'qty'   => 10
        ]);

        $this->productService->create([
            'name' => 'Aciclovir Pomada',
            'brand_id' => 3,
            'price' => 50,
            'qty'   => 10
        ]);
    }
}
