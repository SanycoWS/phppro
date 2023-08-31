<?php

namespace App\Services\SuperVisor;

class ProcessDTO
{
    private string $name;
    private string $command;
    private int $number;

    public function __construct(array $params)
    {
        $this->name = $params['name'];
        $this->command = $params['command'];
        $this->number = $params['number'];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCommand(): string
    {
        return $this->command;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
