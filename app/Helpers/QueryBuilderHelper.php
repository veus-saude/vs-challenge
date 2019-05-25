<?php

namespace App\Helpers;

class QueryBuilderHelper {

    public static function paramsToArray($params) : array
    {
        
        if (!$params) {
            return [];
        }
        
        $array = [];
        $arrayLengthCheck = 2;
        foreach (explode(",", $params) as $value) {
            $values = explode(":", $value);
            if (count($values) == $arrayLengthCheck) {
                $array[$values[0]] = $values[1];
            }
        }

        return $array;
    }

}