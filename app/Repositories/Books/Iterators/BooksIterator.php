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
        // ToDO make group by author_id
//        $data = [];
//        foreach ($collection as $item) {
//            if (key_exists($item->id, $data) === false) {
//                $data[$item->id] = $item;
//                $data[$item->id]->authors = collect();
//            }
//            $data[$item->id]->authors->add(
//                (object)[
//                    'id' => $item->author_id,
//                    'name' => $item->author_name,
//                ]
//            );
//        }
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
