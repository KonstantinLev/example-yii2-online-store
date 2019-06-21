<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 20.06.2019
 * Time: 21:17
 */

namespace src\services\auth;

use src\entities\User\User;
use src\repositories\UserRepository;

class NetworkService
{
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function auth($network, $identity): User
    {
        if ($user = $this->users->findByNetworkIdentity($network, $identity)) {
            return $user;
        }
        $user = User::signupByNetwork($network, $identity);
        $this->users->save($user);
        return $user;
    }
}