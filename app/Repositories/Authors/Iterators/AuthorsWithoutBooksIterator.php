<?php

namespace App\Repositories\Authors\Iterators;

use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class AuthorsWithoutBooksIterator implements IteratorAggregate
{

    protected array $data = [];

    public function __construct(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->data[] = new AuthorWithoutBooksIterator($item);
        }
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }
}
