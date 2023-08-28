<?php

namespace App\Services\GetMyIp;

use App\Services\Proxy\ProxiesStorage;
use GuzzleHttp\Client;

class GetMyIpService
{

    protected const MIN_EXECUTION_SECONDS = 1;

    public function __construct(
        protected Client $client,
        protected ProxiesStorage $proxiesStorage,
    ) {
    }

    public function handle(): string
    {
        $proxy = $this->proxiesStorage->lpop();
        //  $proxy = json_decode(Redis::lpop('proxies'), true);

        $start = microtime(true);
        $response = $this->client->get(
            'https://api.myip.com/',
            [
                'proxy' => $proxy->getData()
            ]
        );
        $end = microtime(true);
        if ($end - $start < self::MIN_EXECUTION_SECONDS) {
            $this->proxiesStorage->rpush($proxy);
            // Redis::rpush('proxies', json_encode($proxy));
        }

        return $response->getBody()->getContents();
    }
}
