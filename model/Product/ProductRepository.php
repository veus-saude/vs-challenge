<?php

namespace Model\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductRepository implements ProductRepositoryInterface
{
    public function get($product_id)
    {
        return Product::fields()->with('brand')->findOrFail($product_id);
    }
    public function all()
    {
        return QueryBuilder::for(Product::class)
            ->fields()
            ->with('brand')
            ->join('brand', 'brand.brand_id', 'product.brand_id')
            ->allowedFilters([
                AllowedFilter::partial('product.name'),
                AllowedFilter::partial('brand.name')
            ])
            ->allowedSorts([
                'product.product_id',
                'product.name',
                'brand.name'
            ])
            ->jsonPaginate();
    }
    public function delete($product_id)
    {
        return Product::destroy($product_id);
    }
    public function update($product_id, array $product_data)
    {
        $product = Product::findOrFail($product_id);
        $product->update($product_data);
        return $product;
    }

    public function create($product_data)
    {
        $product = new Product();
        $product->name = $product_data['name'];
        $product->price = $product_data['price'];
        $product->quantity = $product_data['quantity'];
        $product->brand_id = $product_data['brand_id'];
        $product->save();
        return $product;
    }
}
