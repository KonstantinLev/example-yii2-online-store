<?php
/**
 * Created by PhpStorm.
 * User: x-ste
 * Date: 05.07.2019
 * Time: 15:44
 */

namespace src\services\manage;

use src\entities\User\User;
use src\forms\manage\User\UserCreateForm;
use src\forms\manage\User\UserEditForm;
use src\repositories\UserRepository;

class UserManageService
{
    private $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(UserCreateForm $form): User
    {
        $user = User::create(
            $form->username,
            $form->email,
            $form->password
        );
        $this->repository->save($user);
        return $user;
    }

    public function edit($id, UserEditForm $form): void
    {
        $user = $this->repository->get($id);
        $user->edit(
            $form->username,
            $form->email
        );
        $this->repository->save($user);
    }
}