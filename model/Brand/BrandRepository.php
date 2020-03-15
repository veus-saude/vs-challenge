<?php

namespace Model\Brand;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BrandRepository implements BrandRepositoryInterface
{
    public function get($brand_id)
    {
        return Brand::fields()->findOrFail($brand_id);
    }
    public function all()
    {
        return QueryBuilder::for(Brand::class)
            ->fields()
            ->allowedFilters([
                AllowedFilter::partial('brand.name'),
            ])
            ->allowedSorts([
                'brand.brand_id',
                'brand.name'
            ])
            ->jsonPaginate();
    }
    public function delete($brand_id)
    {
        return Brand::destroy($brand_id);
    }
    public function update($brand_id, array $brand_data)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->update($brand_data);
        return $brand;
    }

    public function create($brand_data)
    {
        $brand = new Brand();
        $brand->name = $brand_data['name'];
        $brand->save();
        return $brand;
    }
}
