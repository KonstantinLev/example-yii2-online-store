<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 07.07.2019
 * Time: 16:05
 */

namespace src\validators;

use yii\validators\RegularExpressionValidator;

class SlugValidator extends RegularExpressionValidator
{
    public $pattern = '/^[a-z0-9_-]*$/s';
    public $message = 'Only [a-z0-9_-] symbols are allowed.';
}