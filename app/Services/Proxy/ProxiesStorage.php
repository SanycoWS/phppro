<?php

namespace App\Services\Proxy;

use Illuminate\Support\Facades\Redis;

class ProxiesStorage
{
    protected const KEY = 'proxies';

    public function lpop(): ProxyDTO
    {
        $data = json_encode(Redis::lpop(self::KEY), true);

        return new ProxyDTO(...$data);
    }

    public function rpop(): ProxyDTO
    {
        $data = json_encode(Redis::rpop(self::KEY), true);

        return new ProxyDTO(...$data);
    }

    public function lpush(ProxyDTO $proxyDTO): void
    {
        Redis::lpush(self::KEY, json_encode($proxyDTO));
    }

    public function rpush(ProxyDTO $proxyDTO): void
    {
        Redis::rpush(self::KEY, json_encode($proxyDTO));
    }
}
