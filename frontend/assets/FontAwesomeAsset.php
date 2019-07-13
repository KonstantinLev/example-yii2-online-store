<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 13.07.2019
 * Time: 10:52
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}