<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 19.06.2019
 * Time: 22:49
 */

namespace frontend\services\contact;


use frontend\forms\ContactForm;
use Yii;
use yii\mail\MailerInterface;

class ContactService
{
    //private $supportEmail;
    private $adminEmail;
    private $mailer;

    public function __construct($adminEmail, MailerInterface $mailer)
    {
        //$this->supportEmail = $supportEmail;
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function send(ContactForm $form): void
    {
        $sent =  $this->mailer->compose()
            //->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            //->setFrom($this->supportEmail)
            ->setTo($this->adminEmail)
            ->setReplyTo([$form->email => $form->name])
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}