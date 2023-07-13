<?php

namespace App\Repositories\Books\Iterators;

use App\Repositories\Categories\Iterators\CategoryIterator;
use Carbon\Carbon;

class BookIterator
{
    protected int $id;
    protected string $name;
    protected int $year;
    protected CategoryIterator $category;
    protected Carbon $createdAt;

    public function __construct(object $data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
        $this->year = $data->year;
        $this->createdAt = new Carbon($data->created_at);
        $this->category = new CategoryIterator(
            $data->category_id,
            $data->category_name,
        );
    }

    /**
     * @return CategoryIterator
     */
    public function getCategory(): CategoryIterator
    {
        return $this->category;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
