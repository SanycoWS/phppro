<?php

namespace App\Services\Books;

use App\Repositories\Books\BookExampleRepository;
use App\Repositories\Books\BookIndexDTO;
use App\Repositories\Books\Iterators\BookIterator;

class BookExampleService
{
    public function __construct(
        protected BookExampleRepository $bookRepository,
    ) {
    }

    public function getSmallPages(BookIndexDTO $data): int
    {
        $this->bookRepository->index($data);

        if (is_null($data->getYear()) === false) {
            $this->bookRepository->filterByYear((int)$data->getYear());
            $this->bookRepository->useYearCreatedAtIndex();
        }
        $result = 0;
        $books = $this->bookRepository->getData();
        /** @var BookIterator $book */
        foreach ($books as $book) {
            if ($book->getPages() <= 100) {
                $result++;
            }
        }

        return $result;
    }

}
