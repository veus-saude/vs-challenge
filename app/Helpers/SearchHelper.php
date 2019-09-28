<?php
/**
 * Created by PhpStorm.
 * User: thiago-hygino
 * Date: 10/05/19
 * Time: 01:04
 */

namespace App\Helpers;


class SearchHelper
{
    public static function queryParamToArray($params) : array
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