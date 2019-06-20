<?php

namespace src\tests\unit\entities\User;

use src\entities\User\User;

class SignupTest extends \Codeception\Test\Unit
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
        $this->assertNotEmpty($user->created_at);
        $this->assertTrue($user->isWait());
        $this->assertFalse($user->isActive());
    }
}