<?php

namespace App\Services\Example\SingleRoute;

use Illuminate\Support\Facades\Redis;

class SingleRouteStorage
{
    protected const KEY = 'single_route';
    protected const EXPIRE = 600;

    public function get(int $userId, string $route): int
    {
        return (int)Redis::get($this->getKey($userId, $route));
    }

    public function set(int $userId, string $route, int $value)
    {
        Redis::set($this->getKey($userId, $route), $value, 'EX', self::EXPIRE);
    }

    public function incr(int $userId, string $route, int $value = 1)
    {
        Redis::incr($this->getKey($userId, $route), $value);
    }

    protected function getKey(int $userId, string $route): string
    {
        return self::KEY . $userId . $route;
    }
}
