<?php

namespace App;

use App\Brand;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class Product extends Model
{
    protected $table = 'product';

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Custom search with pagination
     * @param String search
     * @param String filter
     */
    static function paginate($search = null, $filter = null, $per_page = 15)
    {
        // get brand category, if exists
        if (strpos($filter, 'brand') !== false) {

            $filter = str_replace('brand:', '', $filter);

            //if brand name is invalid, cancel search
            if (!Brand::where('name', $filter)->first()) {
                return false;
            }

            $filter = Brand::where('name', $filter)->first()->id;

        }

        // if user requested valid brand category, use it on eloquent condition
        if ($filter) {

            return Product::where('brand_id', $filter)
                            ->where('name', 'like', '%' . $search . '%' )
                            ->paginate($per_page);
        }

        return Product::where('name', 'like', '%' . $search . '%' )
                            ->paginate($per_page);

    }

}
