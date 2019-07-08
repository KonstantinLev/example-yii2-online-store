<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 08.07.2019
 * Time: 14:51
 */

namespace src\entities\Shop;

use paulzi\nestedsets\NestedSetsBehavior;
use src\entities\behaviors\MetaBehavior;
use src\entities\Meta;
use src\entities\Shop\queries\CategoryQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 *
 * @property Category $parent
 * @property Category[] $parents
 * @property Category[] $children
 * @property Category $prev
 * @property Category $next
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    public $meta;

    public static function tableName(): string
    {
        return '{{%shop_categories}}';
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::className(),
            NestedSetsBehavior::className(),
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function create($name, $slug, $title, $description, Meta $meta): self
    {
        $category = new static();
        $category->name = $name;
        $category->slug = $slug;
        $category->title = $title;
        $category->description = $description;
        $category->meta = $meta;
        return $category;
    }

    public function edit($name, $slug, $title, $description, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->title = $title;
        $this->description = $description;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}