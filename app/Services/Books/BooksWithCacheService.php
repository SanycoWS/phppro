<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;

class BooksWithCacheService
{

    public function __construct(
        protected AllBooksStorage $booksStorage,
        protected BookRepository $bookRepository
    ) {
    }

    public function getAll(int $lastId)
    {
        $hasData = $this->booksStorage->has($lastId);
        if ($hasData === true) {
            return $this->booksStorage->get($lastId);
        }
        $data = $this->bookRepository->getAllDataIteratorNoCache($lastId);
        $this->booksStorage->set($lastId, $data);

        return $data;
    }
}
