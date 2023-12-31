<?php

namespace App\Services\Rabbit\Messages;

class CategoryCreateMessageDTO extends BaseMessage
{
    protected string $name;
    protected int $createdAt;
    protected int $updatedAt;

    public function __construct(object $data)
    {
        $this->name = $data->name;
        $this->createdAt = $data->createdAt;
        $this->updatedAt = $data->updatedAt;
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
