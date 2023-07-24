<?php

namespace App\Services\Users;

use App\Repositories\Users\Itterators\UserIterator;
use App\Repositories\Users\UsersRepository;

class UserLoginService
{

    public function __construct(
        protected UsersRepository $usersRepository,
        protected UserAuthService $authService
    ) {
    }

    public function login(array $data): ?UserIterator
    {
        $isCorrectUserData = $this->authService->isCorrectUserData($data);
        if ($isCorrectUserData === false) {
            return null;
        }

        $id = $this->authService->getUserId();

        return $this->usersRepository->getById($id);
    }

    public function getById(int $id): UserIterator
    {
        return $this->usersRepository->getById($id);
    }

    public function getToken(): string
    {
        return $this->authService->createToken();
    }
}
