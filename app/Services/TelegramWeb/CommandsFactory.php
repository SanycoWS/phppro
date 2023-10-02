<?php

namespace App\Services\TelegramWeb;

use App\Enums\TelegramCommands;
use App\Services\TelegramWeb\Handlers\DownloadFileHandler;
use App\Services\TelegramWeb\Handlers\InfoHandler;
use App\Services\TelegramWeb\Handlers\LoadBookHandler;

class CommandsFactory
{
    public function handle(TelegramCommands $telegramCommands): CommandsInterface
    {
        return match ($telegramCommands) {
            TelegramCommands::INFO => app(InfoHandler::class),
            TelegramCommands::LOAD_BOOK => app(LoadBookHandler::class),
            TelegramCommands::DOWNLOAD_FILE => app(DownloadFileHandler::class),
        };
    }
}
