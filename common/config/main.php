<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
//    'container' => [
//        'yii\data\Pagination' => [
//            'pageSize' => 50
//        ]
//    ],
    'bootstrap' => [
        'common\bootstrap\SetUp'
    ],
    'components' => [
//        'cache' => [
//            'class' => 'yii\caching\MemCache',
//            //'useMemcached' => true
//        ],
    ],
];
