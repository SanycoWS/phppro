<?php

namespace App\Repositories\Books\Iterators;

use ArrayIterator;
use Illuminate\Support\Collection;
use IteratorAggregate;

class BooksIterator implements IteratorAggregate
{

    protected array $data = [];

    public function __construct(Collection $collection)
    {
        foreach ($collection as $item) {
            $this->data[] = new BookIterator($item);
        }
    }

    public function add(BookIterator $bookIterator)
    {
        $this->data[] = $bookIterator;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->data);
    }
}
