<?php

namespace App\Services\Rabbit\Messages;

class CategoryCreateMessageDTO implements \JsonSerializable
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

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
