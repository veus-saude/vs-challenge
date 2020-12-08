<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterModel extends Model
{
    protected $fillable = [];

    public function scopeFilter($builder, $request)
    {
        if(!$request) {
            return $builder;
        }
        $tableName = $this->getTable();

        $productName = $request->has('q') ? $request->q : false;
        $filterOption = $request->has('filter') ? $request->filter : false;
        $sort = $request->has('sort') ? $request->sort : 'name,asc';
        $orderBy = explode(',', $sort);

        $defaultFillableFields = $this->fillable;
        if($orderBy[0] != 'id' && !in_array($orderBy[0], $defaultFillableFields)) {
            $orderBy = false;
        }

        $productBrand = false;
        if (!empty($filterOption)) {
            $filterOptionArray = explode(':', $filterOption);
            if (strtolower($filterOptionArray[0]) == 'brand') $productBrand = $filterOptionArray[1];
        }

        $builder->where(function ($q) use($productName, $productBrand){
            if ($productName)
                $q->where('name', 'like', $productName . '%');
            if ($productBrand){
                $q->whereHas('brand', function ($q) use ($productBrand){
                    $q->where('name', 'like', $productBrand . '%');
                });
            }
        })
        ->with('brand');

        if ($orderBy) {
            $builder->orderBy($orderBy[0], $orderBy[1]);
        }

        return $builder->jsonPaginate();
    }
}
