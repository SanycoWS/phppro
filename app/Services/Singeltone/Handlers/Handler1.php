<?php

namespace App\Services\Singeltone\Handlers;

use App\Services\Singeltone\SaveDataStorage;
use App\Services\Singeltone\SaveDataStorageClear;
use App\Services\Singeltone\SendDataDTO;
use Closure;

class Handler1
{
    public function __construct(
        protected SaveDataStorage $saveDataStorage
    ) {
    }

    public function __destruct()
    {
        echo 'Handler1 destroyed';
    }

    public function handle(SendDataDTO $DTO, Closure $next): SendDataDTO
    {
        echo 'hi from Handler1' . PHP_EOL;
//        echo $this->saveDataStorage->getCount() . PHP_EOL;
//        $this->saveDataStorage->setCount(5);
//        echo $this->saveDataStorage->getCount() . PHP_EOL;

        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;
        SaveDataStorageClear::getInstance()->setCount(55);
        echo SaveDataStorageClear::getInstance()->getCount() . PHP_EOL;

        return $next($DTO);
    }
}
