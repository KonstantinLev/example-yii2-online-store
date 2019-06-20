<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 1:42 PM
 */

namespace common\repositories;

use common\entities\User;

class UserRepository
{
    public function getByEmailConfirmToken(string $token): User
    {
        return $this->getBy(['verification_token' => $token]);
    }

    public function getByEmail(string $email): User
    {
        return $this->getBy(['status' => User::STATUS_ACTIVE, 'email' => $email]);
    }

    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existsByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function getBy(array $condition): User
    {
        //if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
        if (!$user = User::findOne($condition)) {
            throw new NotFoundException('User is not found.');
        }
        return $user;
    }
}