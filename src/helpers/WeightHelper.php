<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 11.07.2019
 * Time: 21:26
 */

namespace src\helpers;

class WeightHelper
{
    public static function format($weight): string
    {
        return $weight / 1000 . ' kg';
    }
}