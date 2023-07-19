<?php

namespace App\Repositories\Books;

use App\Enum\LangEnum;
use Carbon\Carbon;

class BookStoreDTO
{

    public function __construct(
        protected string $name,
        protected int $year,
        protected LangEnum $lang,
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
     * @return LangEnum
     */
    public function getLang(): LangEnum
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
