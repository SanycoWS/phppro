<?php

namespace App\Services\Messenger;

use App\Enums\Messenger;
use App\Services\Messenger\SlackMessenger\SlackMessengerService;
use App\Services\Messenger\TelegramMessenger\TelegramMessengerService;

class MessengerFactory
{
    public function handle(Messenger $messenger): MessengerInterface
    {
        return match ($messenger) {
            Messenger::SLACK => app(SlackMessengerService::class),
            Messenger::TELEGRAM => app(TelegramMessengerService::class),
        };
    }
}
