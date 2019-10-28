<?php

namespace App\Common;

/**
 * This class is used to adapter the results before sending
 */
class AdapterResults
{

    /**
     * Extract the attributes of etities
     *
     * @since 1.0
     * @param mixed $entity
     * @return \stdClass
     */
    private static function makeObject($entity)
    {
        $methodsGet = get_class_methods($entity);
        $methodsGet = array_filter($methodsGet, function($value) {
            return (bool) preg_match('/^get.*$/', $value);
        });
        $std = new \stdClass();
        foreach ($methodsGet as $attribute) {
            $name = str_replace('get', '', $attribute);
            $name = lcfirst($name);
            $std->$name = $entity->$attribute();
        }
        return $std;
    }

    /**
     * Adapter the results
     *
     * @since 1.0
     * @param mixed $result
     * @return \stdClass
     */
    final public static function adapter($result)
    {
        if (is_array($result)) {
            $arr = [];
            foreach ($result as $key => $value) {
                $arr[$key] = self::makeObject($value);
            }
            return $arr;
        }

        return self::makeObject($result);
    }
}
