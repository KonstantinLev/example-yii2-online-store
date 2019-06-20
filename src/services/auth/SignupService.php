<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/17/19
 * Time: 1:19 PM
 */

namespace src\services\auth;

use src\entities\User\User;
use src\forms\auth\SignupForm;
use Yii;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form): void
    {
//        if (User::find()->andWhere(['username' => $form->username])) {
//            throw new \DomainException('Username is already exist.');
//        }
//
//        if (User::find()->andWhere(['email' => $form->email])) {
//            throw new \DomainException('Email is already exist.');
//        }
        $user = User::requestSignup($form->username,$form->email,$form->password);
        $this->save($user);
        $sent = $this
            ->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            //->setFrom($this->supportEmail)
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
        //return $user;
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \RuntimeException('Empty confirm token.');
        }
        $user = $this->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->save($user);
    }

    private function getByEmailConfirmToken(string $token): User
    {
        if (!$user = User::findOne(['verification_token' => $token])) {
            throw new \RuntimeException('User is not found.');
        }
        return $user;
    }

    private function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}