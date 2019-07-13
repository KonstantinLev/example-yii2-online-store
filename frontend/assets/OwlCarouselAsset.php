<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 13.07.2019
 * Time: 10:55
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class OwlCarouselAsset extends AssetBundle
{
    public $sourcePath = '@bower/owl.carousel/dist';
    public $css = [
        'assets/owl.carousel.css',
    ];
    public $js = [
        'owl.carousel.js',
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}