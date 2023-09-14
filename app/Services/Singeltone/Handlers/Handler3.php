<?php

namespace App\Services\Singeltone\Handlers;

use App\Services\Singeltone\SaveDataStorage;
use App\Services\Singeltone\SaveDataStorageClear;
use App\Services\Singeltone\SendDataDTO;
use Closure;

class Handler3
{
    public function __construct(
        protected SaveDataStorage $saveDataStorage
    ) {
    }

    public function handle(SendDataDTO $DTO, Closure $next): SendDataDTO
    {
        echo 'hi from Handler3' . PHP_EOL;
//        echo $this->saveDataStorage->getCount() . PHP_EOL;

        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;
        SaveDataStorageClear::getInstance()->setCount(99);
        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;

        return $next($DTO);
    }
}
