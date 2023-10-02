<?php

namespace App\Services\Messenger\TelegramMessenger;

use App\Services\Messenger\MessengerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TelegramMessengerService implements MessengerInterface
{

    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * @param string $message
     * @param int|null $chatId
     * @return bool
     * @throws GuzzleException
     */
    public function send(string $message, int $chatId = null): bool
    {
        if (is_null($chatId)) {
            $chatId = config('message.telegram.chat_id');
        }
        $this->client->post(config('message.telegram.url'), [
            'json' => [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        ]);

        return true;
    }

    public function sendFile(string $pathToFile, int $chatId = null)
    {
        if (is_null($chatId)) {
            $chatId = config('message.telegram.chat_id');
        }
        Log::info($pathToFile);
        $this->client->post('https://api.telegram.org/bot' . config('message.telegram.token') . '/sendDocument', [
            'query' => [
                'chat_id' => $chatId,
            ],
            'multipart' => [
                [
                    'name' => 'document',
                    'contents' => Storage::get($pathToFile),
                    'filename' => 'filename.log',
                ]
            ]
        ]);
    }
}
