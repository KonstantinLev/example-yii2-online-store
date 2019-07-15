<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 15.07.2019
 * Time: 10:22
 */

namespace src\readModels\Shop;

use src\entities\Shop\Tag;

class TagReadRepository
{
    public function find($id): ?Tag
    {
        return Tag::findOne($id);
    }
}