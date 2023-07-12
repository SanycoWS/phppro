<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\Iterators\BookIterator;

class BooksService
{

    public function __construct(
        protected BookRepository $bookRepository
    ) {
    }

    public function store(BookStoreDTO $data): BookIterator
    {
        $bookId = $this->bookRepository->store($data);

        return $this->bookRepository->getById($bookId);
    }
}
