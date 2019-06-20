<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 19.06.2019
 * Time: 7:17
 */

namespace frontend\services\auth;

use common\repositories\UserRepository;
use frontend\forms\PasswordResetRequestForm;
use frontend\forms\ResetPasswordForm;
use Yii;
use yii\mail\MailerInterface;

class PasswordResetService
{
//    /**
//     * @var array
//     */
//    private $supportEmail;
//
    /**
     * @var MailerInterface
     */
    private $mailer;
    private $users;

    public function __construct(MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function request(PasswordResetRequestForm $form): void
    {
        $user = $this->users->getByEmail($form->email);
        $user->requestPasswordReset();
        if (!$user->save()) {
         throw new \RuntimeException('Saving error.');
        }
        $sent = $this
         ->mailer
         ->compose(
             ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
             ['user' => $user]
         )
         //->setFrom($this->supportEmail)
         ->setTo($user->email)
         ->setSubject('Password reset for ' . Yii::$app->name)
         ->send();
        if (!$sent) {
         throw new \RuntimeException('Sending error.');
        }
    }

    public function validateToken($token): void
    {
        if (empty($token) || !is_string($token)) {
         throw new \DomainException('Password reset token cannot be blank.');
        }
        if (!$this->users->existsByPasswordResetToken($token)) {
         throw new \DomainException('Wrong password reset token.');
        }
    }

    public function reset(string $token, ResetPasswordForm $form): void
     {
         $user = $this->users->getByPasswordResetToken($token);
         $user->resetPassword($form->password);
         $this->users->save($user);
     }
}