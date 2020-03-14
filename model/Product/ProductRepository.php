<?php

namespace Model\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductRepository implements ProductRepositoryInterface
{
    public function get($product_id)
    {
        return Product::fields()->with('brand')->firstOrFail($product_id);
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
            ->get();
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
}
