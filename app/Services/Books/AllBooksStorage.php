<?php

namespace App\Services\Books;

use Illuminate\Support\Facades\Cache;

class AllBooksStorage
{

    protected const KEY = 'books';

    public function has(int $lastId): bool
    {
        return Cache::has($this->getKey($lastId));
    }

    public function get(int $lastId)
    {
        return Cache::get($this->getKey($lastId));
    }

    public function set(int $lastId, array $data)
    {
        Cache::set($this->getKey($lastId), $data);
    }

    private function getKey(int $lastId): string
    {
        return self::KEY . '_' . $lastId;
    }
}
