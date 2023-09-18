<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\Iterators\BookIterator;
use App\Services\Messenger\MessengerInterface;

class BookStoreService
{

    public function __construct(
        protected BookRepository $bookRepository,
        protected MessengerInterface $messenger
    ) {
    }

    /**
     * @param BookStoreDTO $data
     * @return BookIterator
     */
    public function handle(BookStoreDTO $data): BookIterator
    {
        $name = $data->getName();
        $name = mb_strtolower($name);
        $name = ucfirst($name);
        $data->setName($name);

        // $book = $this->bookRepository->find($data->getYear());

        $bookId = $this->bookRepository->store($data);

        $book = $this->bookRepository->getById($bookId);

        return $book;
    }
}
