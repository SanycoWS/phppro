<?php

namespace App\Services\Users\Login;

use App\Services\Users\Login\Handlers\CheckValidDataHandler;
use App\Services\Users\Login\Handlers\CheckWhiteListIpHandler;
use App\Services\Users\Login\Handlers\SetAuthorizedUserHandler;
use App\Services\Users\Login\Handlers\SetLastActivityHandler;
use App\Services\Users\Login\Handlers\SetPersonalTokenHandler;
use Illuminate\Pipeline\Pipeline;

class LoginService
{

    protected const HANDLERS = [
        CheckValidDataHandler::class,
        SetAuthorizedUserHandler::class,
        SetPersonalTokenHandler::class,
        CheckWhiteListIpHandler::class,
        SetLastActivityHandler::class,
    ];

    public function __construct(
        protected Pipeline $pipeline
    ) {
    }

    public function handle(LoginDTO $loginDTO): LoginDTO
    {
        $result = $this->pipeline
            ->send($loginDTO)
            ->through(self::HANDLERS)
            ->then(function (LoginDTO $loginDTO) {
                return $loginDTO;
            });

        return $result;
    }
}
