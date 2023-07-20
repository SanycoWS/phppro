<?php

namespace App\Services\Users;

use App\Repositories\Users\Itterators\UserIterator;
use App\Repositories\Users\UsersRepository;

class UserLoginService
{

    public function __construct(
        protected UsersRepository $usersRepository
    ) {
    }

    public function getById(int $id): UserIterator
    {
        return $this->usersRepository->getById($id);
    }
}
