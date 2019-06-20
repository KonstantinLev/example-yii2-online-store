<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 4:03 PM
 */

namespace frontend\controllers\auth;

use src\forms\auth\PasswordResetRequestForm;
use src\forms\auth\ResetPasswordForm;
use src\services\auth\PasswordResetService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ResetController extends Controller
{
    private $passwordResetService;

    public function __construct(
        $id,
        $module,
        PasswordResetService $passwordResetService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequest()
    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }

        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                //$service = new PasswordResetService();
                $this->passwordResetService->request($form);
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
            } catch (\DomainException $e) { //todo Runtime Exception ??
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address. '.$e->getMessage());
            }
        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionConfirm($token)
    {
        //$service = new PasswordResetService();
        //$service = Yii::$container->get(PasswordResetService::class);

        try {
            //$service->validateToken($token);
            $this->passwordResetService->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                //$service->reset($token, $form);
                $this->passwordResetService->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved.');
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('confirm', [
            'model' => $form,
        ]);
    }
}