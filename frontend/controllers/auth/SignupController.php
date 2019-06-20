<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 4:03 PM
 */

namespace frontend\controllers\auth;

use src\forms\auth\SignupForm;
use src\services\auth\SignupService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignupController extends Controller
{
    private $signupService;

    public function __construct(
        $id,
        $module,
        SignupService $signupService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupService = $signupService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['request'],
                'rules' => [
                    [
                        'actions' => ['request'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
                ],
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionRequest()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                //$user = (new SignupService())->signup($form);
                $this->signupService->signup($form);
                Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                return $this->goHome();
//                if(Yii::$app->getUser()->login($user)){
//                    return $this->goHome();
//                }
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * Confirm email address
     * @param $token
     * @return \yii\web\Response
     */
    public function actionConfirm($token)
    {
        try {
            //$model = new VerifyEmailForm($token);
            $this->signupService->confirm($token);
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            //todo автозалогинивание
            return $this->redirect(['auth/auth/login']);
        } catch (\DomainException $e) {
            //throw new BadRequestHttpException($e->getMessage());
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->goHome();
        }
//        if ($user = $model->verifyEmail()) {
//            if (Yii::$app->user->login($user)) {
//
//                return $this->goHome();
//            }
//        }

//        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
//        return $this->goHome();
    }
}