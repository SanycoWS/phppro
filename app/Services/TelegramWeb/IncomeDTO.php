<?php

namespace App\Services\TelegramWeb;

use Carbon\Carbon;

class IncomeDTO
{
    protected int $updateId;
    protected int $senderId;
    protected string $text;
    protected Carbon $date;

    public function __construct(array $data)
    {
        $this->updateId = $data['update_id'];
        $this->text = $data['message']['text'];
        $this->senderId = $data['message']['from']['id'];
        $this->date = Carbon::createFromTimestamp($data['message']['date']);
        /**
         * {
         * "update_id":273471395,
         * "message":{
         * "message_id":49,
         * "from":{
         * "id":514530769,
         * "is_bot":false,
         * "first_name":"Taras",
         * "last_name":"Kutsyy \ud83c\uddfa\ud83c\udde6",
         * "username":"TarasKutsyy",
         * "language_code":"uk"
         * },
         * "chat":{
         * "id":514530769,
         * "first_name":"Taras",
         * "last_name":"Kutsyy \ud83c\uddfa\ud83c\udde6",
         * "username":"TarasKutsyy",
         * "type":"private"
         * },
         * "date":1696264882,
         * "text":"test"
         * }
         * }
         */
    }

    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

}
