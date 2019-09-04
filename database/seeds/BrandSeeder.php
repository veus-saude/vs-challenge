<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * @var \App\Services\BrandService
     */
    private $brandService;

    /**
     * BrandSeeder constructor.
     */
    public function __construct(\App\Services\BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->brandService->create(['name' => 'Cifarma']);
        $this->brandService->create(['name' => 'Natele']);
        $this->brandService->create(['name' => 'Natulab']);
        $this->brandService->create(['name' => 'Virbac']);
        $this->brandService->create(['name' => 'CIMED']);
        $this->brandService->create(['name' => 'Avon']);
    }
}
