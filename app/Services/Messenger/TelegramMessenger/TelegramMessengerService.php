<?php

namespace App\Services\Messenger\TelegramMessenger;

use App\Services\Messenger\MessengerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;

class TelegramMessengerService implements MessengerInterface
{

    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws \Exception
     */
    public function send(string $message): bool
    {
        $bot = new \TelegramBot\Api\BotApi(config('message.telegram.token'));

        //$bot->sendMessage(config('message.telegram.chat_id'), 'Hello World from package');
        $bot->sendMessage(514530769, 'Hello World from package');

        $this->client->post(config('message.telegram.url'), [
            'json' => [
                'chat_id' => config('message.telegram.chat_id'),
                'text' => $message,
            ]
        ]);

        return true;
    }
}
