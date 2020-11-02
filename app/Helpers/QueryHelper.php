<?php
namespace App\Helpers;

class QueryHelper
{
    public static function paramsToArray($params)
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