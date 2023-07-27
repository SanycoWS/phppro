<?php

namespace App\Services\Users\Login\Handlers;

use App\Services\Users\Login\LoginDTO;
use App\Services\Users\Login\LoginInterface;
use Closure;

class CheckValidDataHandler implements LoginInterface
{

    public function handle(LoginDTO $loginDTO, Closure $next): LoginDTO
    {
        // do check
        $data = [
            'email' => $loginDTO->getEmail(),
            'password' => $loginDTO->getPassword(),
        ];
        if (auth()->attempt($data) === false) {
            return $loginDTO;
        }

        return $next($loginDTO);
    }
}
