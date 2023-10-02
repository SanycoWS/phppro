<?php

namespace App\Services\TelegramWeb;

use App\Enums\TelegramCommands;
use App\Services\Messenger\TelegramMessenger\TelegramMessengerService;
use Illuminate\Support\Facades\Redis;

class TelegramIncomeService
{

    public function __construct(
        protected TelegramMessengerService $telegramMessengerService,
        protected CommandsFactory $factory,
    ) {
    }

    public function handle(IncomeDTO $data)
    {
        $command = TelegramCommands::tryFrom($data->getText());
        if (is_null($command)) {
            $command = TelegramCommands::from(Redis::get('lastCommand' . $data->getSenderId()));
        }
        Redis::set('lastCommand' . $data->getSenderId(), $command->value);

        $commands = $this->factory->handle($command);
        $this->telegramMessengerService->send(
            $commands->handle($data->getText()),
            $data->getSenderId()
        );

        $this->telegramMessengerService->sendFile(storage_path('logs/') . 'test.log', $data->getSenderId());
    }
}
