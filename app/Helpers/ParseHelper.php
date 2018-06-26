<?php

namespace App\Helpers;

class ParseHelper
{
    public static function arrayRequestToArray(array $arrayRequest = [], $return = [])
    {
        foreach ($arrayRequest as $column => $values) {
            foreach ($values as $key => $value) {
                @$return[$key][$column] = $value;
            }
        }

        return $return;
    }
}
