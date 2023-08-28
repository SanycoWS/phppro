<?php

namespace App\Services\Example\MultipleRoute;

use Illuminate\Support\Facades\Redis;

class MultipleRouteStorage
{
    protected const KEY = 'multiple_route';
    protected const EXPIRE = 900;

    public function get(int $userId): int
    {
        return (int)Redis::get($this->getKey($userId));
    }

    public function set(int $userId, int $value)
    {
        Redis::set($this->getKey($userId), $value, 'EX', self::EXPIRE);
    }

    public function incr(int $userId, int $value = 1)
    {
        Redis::incr($this->getKey($userId), $value);
    }

    protected function getKey(int $userId): string
    {
        return self::KEY . $userId;
    }
}
