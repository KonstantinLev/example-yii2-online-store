<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 05.07.2019
 * Time: 12:50
 */

namespace frontend\controllers\profile;


use yii\filters\AccessControl;
use yii\web\Controller;

class IndexController extends Controller
{
    //public $layout = 'profile';

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}