<?php

namespace App\Repositories\Books;

class BookUpdateDTO
{

    public function __construct(
        protected int $id,
        protected string $name,
        protected int $year,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

}
