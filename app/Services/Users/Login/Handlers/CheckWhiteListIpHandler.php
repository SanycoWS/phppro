<?php

namespace App\Services\Users\Login\Handlers;

use App\Repositories\WhiteListIps\WhiteListIpRepository;
use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginInterface;
use Closure;

class CheckWhiteListIpHandler implements LoginInterface
{

    public function __construct(
        protected WhiteListIpRepository $whiteListIpRepository
    ) {
    }

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $exist = $this->whiteListIpRepository->existByUserIdByIp(
            $loginDTO->getUser()->getId(),
            request()->ip()
        );

        if ($exist === false) {
            return $loginDTO;
        }

        return $next($loginDTO);
    }
}
