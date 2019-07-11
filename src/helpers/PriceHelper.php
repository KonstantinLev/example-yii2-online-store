<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 11.07.2019
 * Time: 21:24
 */

namespace src\helpers;

class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
}