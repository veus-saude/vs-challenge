<?php

namespace app\model;

class convertModel {

    public function utf8_converter($array) {

        array_walk_recursive($array, function(&$item, $key) {

            if (!mb_detect_encoding($item, 'utf-8', true)) {

                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    public function array_converter($array) {

        $newArray = [];
        foreach ($array as $item) {

            $newArray[ucfirst($item[0])] = (int) $item[1];
        }

        return $newArray;
    }

}
