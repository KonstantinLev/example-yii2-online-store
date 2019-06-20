<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 11:21 AM
 */

namespace src\tests\unit\entities\User;

use Codeception\Test\Unit;
use src\entities\User\User;

class ConfirmSignupTest extends Unit
{
    public function testSuccess()
    {
        $user = new User([
           'status' => User::STATUS_WAIT,
           'verification_token' => 'token'
        ]);

        $user->confirmSignup();

        $this->assertEmpty($user->verification_token);
        $this->assertFalse($user->isWait());
        $this->assertTrue($user->isActive());
    }

    public function testAlreadyActive()
    {
        $user = new User([
            'status' => User::STATUS_ACTIVE,
            'verification_token' => null
        ]);
        $this->expectExceptionMessage('User is already active.');
        $user->confirmSignup();
    }
}