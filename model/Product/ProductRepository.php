<?php

namespace Model\Product;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductRepository implements ProductRepositoryInterface
{
    public function get($product_id)
    {
        return Product::findOrFail($product_id);
    }
    public function all()
    {
        return QueryBuilder::for(Product::class)
            ->join('brand', 'brand.brand_id', 'product.brand_id')
            ->allowedFilters([
                AllowedFilter::partial('name'),
                AllowedFilter::partial('brand.name','brand')
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
