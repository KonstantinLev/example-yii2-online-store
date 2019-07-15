<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 15.07.2019
 * Time: 11:02
 */

namespace src\readModels\Shop\views;

use src\entities\Shop\Category;

class CategoryView
{
    public $category;
    public $count;

    public function __construct(Category $category, $count)
    {
        $this->category = $category;
        $this->count = $count;
    }
}