<?php

namespace App\Services\Messenger\TelegramMessenger;

use App\Services\Messenger\MessengerInterface;

class TelegramMessengerService implements MessengerInterface
{

    public function send(string $message): bool
    {
        return true;
    }
}
