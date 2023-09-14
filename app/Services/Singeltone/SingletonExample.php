<?php

namespace App\Services\Singeltone;

use App\Services\Singeltone\Handlers\Handler1;
use App\Services\Singeltone\Handlers\Handler2;
use App\Services\Singeltone\Handlers\Handler3;
use Illuminate\Pipeline\Pipeline;

class SingletonExample
{
    const HANDLERS = [
        Handler1::class,
        Handler2::class,
        Handler3::class,
    ];

    public function __construct(
        protected Pipeline $pipeline,
        protected SaveDataStorage $saveDataStorage,
    ) {
    }

    public function handle()
    {
        $dto = new SendDataDTO();
        $this->pipeline
            ->send($dto)
            ->through(self::HANDLERS)
            ->then(function (SendDataDTO $DTO) {
                return $DTO;
            });
        echo 'SingletonExample: ' . $this->saveDataStorage->getCount() . PHP_EOL;
    }
}
