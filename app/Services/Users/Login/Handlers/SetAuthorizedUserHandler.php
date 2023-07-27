<?php

namespace App\Services\Users\Login\Handlers;

use App\Repositories\Users\UsersRepository;
use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginInterface;
use Closure;

class SetAuthorizedUserHandler implements LoginInterface
{

    public function __construct(
        protected UsersRepository $usersRepository
    ) {
    }

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $user = $this->usersRepository->getById(
            auth()
                ->id()
        );
        $loginDTO->setUser($user);

        return $next($loginDTO);
    }
}
