<?php

namespace App\Services\BookByCommand;

use App\Enums\Lang;
use App\Repositories\Books\BookStoreDTO;
use App\Services\Books\BookStoreService;
use GuzzleHttp\Client;

class BookCreateService
{

    public function __construct(
        protected Client $client,
        protected BookStoreService $bookStoreService,
    ) {
    }

    public function handle()
    {
        $this->bookStoreService->handle(
            new BookStoreDTO(
                "test" . rand(1, 999),
                rand(1, 999),
                Lang::UA,
                now(),
            )
        );

        echo 'Created' . time() . PHP_EOL;
    }
}
