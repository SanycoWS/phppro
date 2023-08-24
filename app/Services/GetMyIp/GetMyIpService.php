<?php

namespace App\Services\GetMyIp;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class GetMyIpService
{

    public function __construct(
        protected Client $client
    ) {
    }

    public function handle(): string
    {
        $proxy = json_decode(Redis::lpop('proxies'), true);

        $userData = $proxy['username'] . ':' . $proxy['password'];
        $response = $this->client->get(
            'https://api.myip.com/',
            [
                'proxy' => 'http://' . $userData . '@' . $proxy['ip'] . ':' . $proxy['port'],
            ]
        );

        Redis::rpush('proxies', json_encode($proxy));

        return $response->getBody()->getContents();
    }
}
