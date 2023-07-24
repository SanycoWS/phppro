<?php

namespace App\Repositories\Books;

use App\Enums\Lang;
use Carbon\Carbon;

class BookStoreDTO
{

    public function __construct(
        protected string $name,
        protected int $year,
        protected Lang $lang,
        protected Carbon $createdAt
    ) {
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Lang
     */
    public function getLang(): Lang
    {
        return $this->lang;
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
