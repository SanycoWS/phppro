<?php

namespace App\Services\Proxy;

use GuzzleHttp\Client;

class WebShareService
{

    public function __construct(
        protected Client $client,
        protected ProxiesStorage $proxiesStorage,
    ) {
    }

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getProxyList(): void
    {
        $response = $this->client->get(
            'https://proxy.webshare.io/api/v2/proxy/list',
            [
                'query' => [
                    'mode' => 'direct',
                ],
                'headers' => [
                    'Authorization' => 'Token ' . config('proxy.key'),
                ]
            ]
        );
        $content = $response->getBody()->getContents();
        $proxies = [];
        foreach (json_decode($content)->results as $result) {
            $proxy = [
                'username' => $result->username,
                'password' => $result->password,
                'ip' => $result->proxy_address,
                'port' => $result->port,
            ];
            $this->proxiesStorage->lpush(new ProxyDTO(...$proxy));
            //   Redis::lpush('proxies', json_encode($proxy));
            $proxies[] = $proxy;
        }
        print_r($proxies);
    }
}
