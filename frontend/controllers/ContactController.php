<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 4:02 PM
 */

namespace frontend\controllers;

use src\forms\ContactForm;
use src\services\contact\ContactService;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
{
    private $contactService;

    public function __construct(
        $id,
        $module,
        ContactService $contactService,
        $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->contactService = $contactService;
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->contactService->send($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                return $this->goHome();
            } catch (\Exception $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $form,
            ]);
        }
    }
}