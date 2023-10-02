<?php

namespace App\Services\TelegramWeb\Handlers;

use App\Enums\TelegramCommands;
use App\Services\TelegramWeb\CommandsInterface;

class InfoHandler implements CommandsInterface
{
    public function handle(string $arguments): string
    {
        $result = 'List of commands:' . PHP_EOL;
        foreach (TelegramCommands::cases() as $command) {
            $result .= $command->value . PHP_EOL;
        }

        return $result;
    }
}
