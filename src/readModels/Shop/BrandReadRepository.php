<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 15.07.2019
 * Time: 10:22
 */

namespace src\readModels\Shop;

use src\entities\Shop\Brand;

class BrandReadRepository
{
    public function find($id): ?Brand
    {
        return Brand::findOne($id);
    }
}