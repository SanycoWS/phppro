<?php

namespace App\Services\Rabbit\Messages;

use App\Enums\Lang;

class BookCreateMessageDTO extends BaseMessage
{

    protected string $name;
    protected Lang $lang;
    protected int $createdAt;
    protected int $updatedAt = 5;

    public function getLang(): Lang
    {
        return $this->lang;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): int
    {
        return $this->updatedAt;
    }

}
