<?php
namespace App\Http\Model\Product;

use App\Support\QueryFilters;

class ProductFilter extends QueryFilters
{

    public function productId($value)
    {
        return $this->builder->where('product_id', '=', $value);
    }

    public function product($value)
    {
        return $this->builder->whereRaw("lower(product_name) like '%".strtolower($value)."%'");
    }

    public function brand($value)
    {
        return $this->builder
        ->join('brand','brand.brand_id','=','product.brand_id')
        ->whereRaw("lower(brand.brand_name) like '%".strtolower($value)."%'");
    }

    public function priceLessThan($value)
    {
        return $this->builder->where('product_price', '<=', $value);
    }

    public function priceMoreThan($value)
    {
        return $this->builder->where('product_price', '>=', $value);
    }

    public function qtyLessThan($value)
    {
        return $this->builder->where('product_qty', '<=', $value);
    }

    public function qtyMoreThan($value)
    {
        return $this->builder->where('product_qty', '>=', $value);
    }

    public function orderAsc($value)
    {
        return $this->builder->orderBy($value);
    }

    public function orderDesc($value)
    {
        return $this->builder->orderBy($value,'desc');
    }

}
