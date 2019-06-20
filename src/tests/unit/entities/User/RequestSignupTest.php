<?php
/**
 * Created by PhpStorm.
 * User: kote
 * Date: 6/20/19
 * Time: 11:19 AM
 */

namespace src\tests\unit\entities\User;

use Codeception\Test\Unit;
use src\entities\User\User;

class RequestSignupTest extends Unit
{
    public function testSuccess()
    {
        $user = User::requestSignup(
            $username = 'username',
            $email = 'email@email.com',
            $password = 'password',
            );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertNotEmpty($user->verification_token);
        $this->assertTrue($user->isWait());
        $this->assertFalse($user->isActive());
    }
}