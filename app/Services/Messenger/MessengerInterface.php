<?php

namespace App\Services\Messenger;

interface MessengerInterface
{
    public function send(string $message): bool;
}
