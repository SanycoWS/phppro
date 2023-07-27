<?php

namespace App\Services\Users\Login\Handlers;

use App\Repositories\LastActivity\LastActivityRepository;
use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginInterface;
use Closure;

class SetLastActivityHandler implements LoginInterface
{

    public function __construct(
        protected LastActivityRepository $lastActivityRepository
    ) {
    }

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $this->lastActivityRepository->store(
            $loginDTO->getUser()->getId(),
            request()->ip()
        );

        return $next($loginDTO);
    }
}
