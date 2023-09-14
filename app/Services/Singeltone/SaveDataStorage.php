<?php

namespace App\Services\Singeltone;

class SaveDataStorage
{
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
