<?php

namespace App\Repositories\Books;

use Carbon\Carbon;

class BookStoreDTO
{

    public function __construct(
        protected string $name,
        protected int $year,
        protected Carbon $createdAt
    ) {
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

}
