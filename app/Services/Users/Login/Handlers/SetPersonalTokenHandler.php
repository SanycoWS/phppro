<?php

namespace App\Services\Users\Login\Handlers;

use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginInterface;
use Closure;

class SetPersonalTokenHandler implements LoginInterface
{

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        $loginDTO->setToken(
            auth()
                ->user()->createToken('secret')
        );

        return $next($loginDTO);
    }
}
