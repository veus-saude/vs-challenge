<?php

namespace App;

use App\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $guarded = [];


    /**
     * Brand belongs to Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

     /**
     * Accessor to get the brand's name.
     *
     * @param  string  $value
     * @return string
     */
    public function getBrandAttribute($value)
    {
        return Brand::find($value)->name;
    }

    /**
     * Products list with pagination, ordering and search features
     * @param String search
     * @param String filter
     * @param String sort
     * @param Integer per_page
     */
    static function paginate($search = null, $filter = null, $sort = null, $per_page = 15)
    {
        // get brand category, if exists
        if (strpos($filter, 'brand') !== false) {

            $filter = str_replace('brand:', '', $filter);

            //if brand name is invalid, cancel search
            if (!Brand::where('name', $filter)->first()) {
                return false;
            }

            $filter = Brand::where('name', $filter)->first()->name;

        }

        // orderBy with switch, because the few ordernation possibilities
        switch ($sort) {
            case 'name':
                $sort = 'product.name ASC';
                break;
            case '-name':
                $sort = 'product.name DESC';
                break;
            case 'brand':
                $sort = 'brand.name ASC';
                break;
            case '-brand':
                $sort = 'brand.name DESC';
                break;
            case '-created_at':
                $sort = 'product.created_at DESC';
                break;
            default:
                $sort = 'product.created_at ASC';
                break;
        }

        // using eloquent awesome features to return results from the list requirements: ordering, searching and pagination
        return Product::select('product.id', 'product.name', 'product.brand_id as brand', 'product.price', 'product.quantity', 'product.created_at')
                    ->join('brand', 'brand.id', 'product.brand_id')
                    ->where('brand.name', 'like', '%' . $filter . '%' )
                    ->where('product.name', 'like', '%' . $search . '%' )
                    ->orderByRaw($sort)
                    ->paginate($per_page);

    }

}
