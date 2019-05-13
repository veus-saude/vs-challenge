<?php

namespace Tests\Unit;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use DatabaseTransactions;

    public function testGetProductsSearchByName()
    {

        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "Arroz"]);

        $product = new Product();
        $this->assertCount(2, $product->getProducts());

        $product->name = "Arroz";
        $this->assertCount(1, $product->getProducts());
    }

    public function testGetProductsSearchByOneFilter()
    {

        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "Brinco", 'brand' => 'Rommanel']);

        $product = new Product();
        $this->assertCount(2, $product->getProducts());

        $product->name = "Brinco";
        $product->filters = [
            'brand' => 'Rommanel',
        ];

        $this->assertCount(1, $product->getProducts());
        $this->assertEquals('Rommanel', $product->getProducts()[0]->brand);
    }

    public function testGetProductsSearchByMultipleFilters()
    {

        factory(Product::class)->create();
        factory(Product::class)->create(['name' => "Brinco", 'brand' => 'Rommanel', 'price' => 2.50]);
        factory(Product::class)->create(['name' => "Brinco", 'brand' => 'Rommanel', 'price' => 2.80]);
        factory(Product::class)->create(['name' => "Brinco", 'brand' => 'Vivara', 'price' => 2.80]);

        $product = new Product();
        $this->assertCount(4, $product->getProducts());

        $product->filters = [
            'brand' => 'Rommanel',
            'price' => 2.80
        ];

        $this->assertCount(1, $product->getProducts());
        $this->assertEquals('Rommanel', $product->getProducts()[0]->brand);
    }

    public function testGetProductsTestSort()
    {


        factory(Product::class)->create(['name' => "Brinco", 'brand' => 'Rommanel']);
        factory(Product::class)->create(['name' => "Pulseira", 'brand' => 'Rommanel']);
        factory(Product::class)->create(['name' => "Anel", 'brand' => 'Rommanel']);

        $product = new Product();
        $product->sorts = [
            'name' => 'ASC',
        ];

        $this->assertEquals('Anel', $product->getProducts()[0]->name);

        $product->sorts = [
            'name' => 'DESC',
        ];

        $this->assertEquals('Pulseira', $product->getProducts()[0]->name);
    }
}
