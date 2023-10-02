<?php

namespace App\Services\TelegramWeb;

interface CommandsInterface
{
    public function handle(string $arguments): string;
}
