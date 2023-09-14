<?php

namespace App\Services\Rabbit\Messages;

class AuthorCreateMessageDTO extends BaseMessage
{

    public function __construct(
        protected string $name,
        protected int $createdAt,
        protected int $updatedAt,
    ) {
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
