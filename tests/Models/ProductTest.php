<?php

namespace Tests\Models;

use App\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testGetProducts()
    {
        factory(Product::class)->create(['name' => "Product 1", 'brand' => 'New Brand', 'price' => 100]);
        factory(Product::class)->create(['name' => "Product 2", 'brand' => 'Other Brand', 'price' => 10]);

        $product = new Product();
        $products = $product->getProducts();

        $this->assertCount(2, $products);
        $this->assertEquals('Product 1', $products[0]->name);
        $this->assertEquals('Product 2', $products[1]->name);
    }

    public function testGetProductsByName()
    {
        factory(Product::class)->create(['name' => "Product 1", 'brand' => 'New Brand', 'price' => 100]);
        factory(Product::class)->create(['name' => "Product 2", 'brand' => 'Other Brand', 'price' => 10]);

        $product = new Product();
        $product->name = "Product 1";

        $this->assertCount(1, $product->getProducts());
    }

    public function testGetProductsByFilters()
    {
        factory(Product::class)->create(['name' => "Product 1", 'brand' => 'New Brand', 'price' => 100]);
        factory(Product::class)->create(['name' => "Product 2", 'brand' => 'Other Brand', 'price' => 10]);
        factory(Product::class)->create(['name' => "Product 3", 'brand' => 'New Brand', 'price' => 1]);

        $product = new Product();
        $product->filters = [
            'brand' => 'New Brand',
            'price' => 100,
        ];
        $this->assertCount(1, $product->getProducts());
        $this->assertEquals('New Brand', $product->getProducts()[0]->brand);
    }

    public function testSortInGetProducts()
    {
        factory(Product::class)->create(['name' => "Product 1", 'brand' => 'New Brand', 'price' => 100]);
        factory(Product::class)->create(['name' => "Product 2", 'brand' => 'Other Brand', 'price' => 10]);
        factory(Product::class)->create(['name' => "Product 3", 'brand' => 'New Brand', 'price' => 1]);

        $product = new Product();
        $product->sortBy = 'price';
        $this->assertEquals('Product 3', $product->getProducts()[0]->name);
    }
}
