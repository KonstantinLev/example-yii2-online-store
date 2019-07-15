<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 15.07.2019
 * Time: 10:42
 */

namespace src\entities\Shop\Product\queries;

use src\entities\Shop\Product\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return ProductQuery
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
        ]);
    }
}