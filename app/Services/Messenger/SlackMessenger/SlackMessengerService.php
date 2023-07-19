<?php

namespace App\Services\Messenger\SlackMessenger;

use App\Services\Messenger\MessengerInterface;

class SlackMessengerService implements MessengerInterface
{

    public function send(string $message): bool
    {
        return true;
    }
}
