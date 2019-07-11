<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 08.07.2019
 * Time: 17:04
 */

namespace src\entities\Shop\Product;

use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yiidreamteam\upload\ImageUploadBehavior;

/**
 * @property integer $id
 * @property string $file
 * @property integer $sort
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_photos}}';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => ImageUploadBehavior::className(),
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480]
                ],
                'filePath' => '@staticRoot/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl' => '@static/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath' => '@staticRoot/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl' => '@static/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
            ],
        ];
    }
}