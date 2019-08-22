<?php

return [
    'class' => 'yii\web\UrlManager',
    //'hostInfo' => '',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '' => 'site/index',
        '<_a:about>' => 'site/<_a>',
        'contact' => 'contact/index',
        'signup' => 'auth/signup/request',
        'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
        '<_a:login|logout>' => 'auth/auth/<_a>',

        'catalog' => 'shop/catalog/index',
        ['class' => 'frontend\urls\CategoryUrlRule'],
        'catalog/<id:\d+>' => 'shop/catalog/product',

        'profile' => 'profile/index/index',
        'profile/<_c:[\w\-]+>' => 'profile/<_c>/index',
        'profile/<_c:[\w\-]+>/<id:\d+>' => 'profile/<_c>/view',
        'profile/<_c:[\w\-]+>/<_a:[\w-]+>' => 'profile/<_c>/<_a>',
        'profile/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => 'profile/<_c>/<_a>',

        '<_c:[\w\-]+>' => '<_c>/index',
        '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
        '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
        '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
    ],
];