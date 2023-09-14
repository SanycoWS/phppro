<?php

namespace App\Services\Singeltone;

class SaveDataStorageClear
{

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected int $count = 0;

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

}
