<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    use DatabaseTransactions;

    public function testSortInGetProducts()
    {
        factory(Product::class)->create(['name' => "Arroz", 'brand' => 'Camil', 'price' => 9.70]);
        factory(Product::class)->create(['name' => "Feijao", 'brand' => 'Maximo', 'price' => 10.00]);
        factory(Product::class)->create(['name' => "Macarrao", 'brand' => 'Piraque', 'price' => 3.50]);
        
        $product = new Product();
        $product->sorts = [
            'name' => 'ASC',
        ];
        $this->assertEquals('Arroz', $product->getProducts()[0]->name);
        
        $product->sorts = ['name' => 'DESC'];

        $this->assertEquals('Macarrao', $product->getProducts()[0]->name);
    }

    public function testSearchByNameInGetProducts()
    {
        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "CocaCola"]);
        
        $product = new Product();
        
        $this->assertCount(2, $product->getProducts());
        
        $product->name = "CocaCola";
        $this->assertCount(1, $product->getProducts());
    }
    
    public function testSearchByOneFilterInGetProducts()
    {
        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "Celular", 'brand' => 'Apple']);
        
        $product = new Product();
        $this->assertCount(2, $product->getProducts());
        
        $product->name = "Celular";
        $product->filters = [
            'brand' => 'Apple',
        ];
        
        $this->assertCount(1, $product->getProducts());
        $this->assertEquals('Apple', $product->getProducts()[0]->brand);
    }
    
    public function testSearchMultipleFiltersInGetProducts()
    {
        $product = new Product();

        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "Feijao", 'brand' => 'Maximo', 'price' => 10.00]);
        factory(Product::class)->create(['name' => "Macarrao", 'brand' => 'Piraque', 'price' => 3.50]);
        
        $this->assertCount(3, $product->getProducts());
        $product->filters = [
            'brand' => 'Maximo',
            'price' => 10.00
        ];
        $this->assertCount(1, $product->getProducts());
        $this->assertEquals('Maximo', $product->getProducts()[0]->brand);
    }
}