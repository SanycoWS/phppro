<?php

namespace App\Services\TelegramWeb\Handlers;

use App\Services\TelegramWeb\CommandsInterface;

class DownloadFileHandler implements CommandsInterface
{
    public function handle(string $arguments): string
    {
        return 'download by link: https://29ca-178-137-169-209.ngrok-free.app/api/download/test.log';
    }
}
