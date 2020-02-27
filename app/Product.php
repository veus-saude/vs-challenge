<?php

namespace App;

use App\Brand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'amount', 'brand',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get the Gerente record associated with the Product.
     */
    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');

    }

    public function scopeSearch($query, $inputs)
    {

        if (!isset($inputs['q'])) {
            return $query;
        }

        return $query->where(function ($query) use ($inputs) {
            $query
                ->orWhere('name', 'like', '%' . $inputs['q'] . '%')
                ->orWhere('price', 'like', '%' . $inputs['q'] . '%')
                ->orWhere('amount', 'like', '%' . $inputs['q'] . '%')
                ->orWhere('brand', 'like', '%' . $inputs['q'] . '%');

        });
    }

    public function scopeFilter($query, $inputs)
    {

        $parts = explode(':', $inputs['filter']);

        if (count($parts) == 3) {

            if ($parts[1] == 'LIKE' || $parts[1] == 'like') {
                return $query->where($parts[0], 'LIKE', '%' . $parts[2] . '%');
            } else if ($parts[1] == 'IN' || $parts[1] == 'in') {
                return $query->whereIn($parts[0], explode(',', $parts[2]));
            } else {
                return $query->where($parts[0], $parts[1], $parts[2]);
            }
        } else $query;

    }

    public function scopeSort($query, $inputs)
    {
        if (!isset($inputs['sort'])) {
            return $query;
        }

        $orderby = 'ASC';
        $sort = explode(',', $inputs['sort']);
        //limitar possíveis valores invalidos
        if (isset($sort[1]) && (stristr($sort[1], 'ASC') || stristr($sort[1], 'DESC'))) {
            $orderby = $sort[1];
        } else {
            return $query;
        }

        return $query->orderBy($sort[0], $orderby);
    }

    public function scopePaginates($query, $inputs)
    {
        $totalpages = 1;
        if (!isset($inputs['p'])) {
            return $query->paginate($totalpages);
        }

        $totalpages = $inputs['p'];

        return $query->paginate($totalpages);
    }

}
