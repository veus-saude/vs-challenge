<?php
namespace App\Traits;
use Illuminate\Support\Facades\Schema;

trait ApiQueryBuilder
{
    public static function getWithApiQueryParams($params)
    {
        $query = self::query();

        $per_page = (isset($params['per_page']))? $per_page = $params['per_page'] : $per_page = 10;
        $q = (isset($params['q']))? $q = $params['q'] : $q = null;
        $filters = (isset($params['filter']))? self::queryParamToArray($params['filter']) : [];
        $sorts =  (isset($params['sort']))? self::queryParamToArray($params['sort']) : [];

        $query->ofSearch($q);
        $query->ofSort($sorts);
        $query->ofFilter($filters);


        foreach ($filters as $field => $value) {
            $query->where($field , $value);
        }

        return $query->paginate($per_page);
    }

    public function scopeOfSearch($query, $q)
    {
        if ( $q ) {

            $columns = Schema::getColumnListing(self::getTable());

            foreach($columns as $column) {
                if(in_array($column, $columns)) {
                    $query->orWhere($column, 'LIKE', '%' . $q . '%');
                }
            }
        }

        return $query;
    }

    public function scopeOfSort($query, $sorts = [])
    {
        if ( ! empty($sorts) ) {

            $columns = Schema::getColumnListing(self::getTable());

            foreach ( $sorts as $column => $direction ) {
                if(in_array($column, $columns)) {
                    $direction = in_array($direction, ['asc', "desc"]) ? $direction : "asc";
                    $query->orderBy($column, $direction);
                }
            }
        }

        return $query;
    }

    public function scopeOfFilter($query, $filters = [])
    {
        if ( ! empty($filters) ) {

            $columns = Schema::getColumnListing(self::getTable());

            foreach ( $filters as $column => $value ) {
                if(in_array($column, $columns)) {
                    $query->where($column , $value);
                }
            }
        }

        return $query;
    }

    public static function queryParamToArray($params)
    {

        if(!$params){
            return [];
        }

        $arr = [];

        foreach (explode(",", $params) as $value) {
            $values = explode(":", $value);
            if(count($values) == 2){
                $arr[$values[0]] = $values[1];
            }
        }

        return $arr;
    }
}