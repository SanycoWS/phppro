<?php

namespace App\Services\Singeltone\Handlers;

use App\Services\Singeltone\SaveDataStorage;
use App\Services\Singeltone\SaveDataStorageClear;
use App\Services\Singeltone\SendDataDTO;
use Closure;

class Handler2
{
    public function __construct(
        protected SaveDataStorage $saveDataStorage
    ) {
    }

    public function handle(SendDataDTO $DTO, Closure $next): SendDataDTO
    {
        echo 'hi from Handler2' . PHP_EOL;
//        echo $this->saveDataStorage->getCount() . PHP_EOL;
//        $this->saveDataStorage->setCount(7);
//        echo $this->saveDataStorage->getCount(). PHP_EOL;

        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;
        SaveDataStorageClear::getInstance()->setCount(77);
        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;

        return $next($DTO);
    }
}
