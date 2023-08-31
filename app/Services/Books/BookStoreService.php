<?php

namespace App\Services\Books;

use App\Events\BookCreated;
use App\Exceptions\BookStoreElseException;
use App\Exceptions\BookStoreException;
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

        $existName = $this->bookRepository->existByName($data->getName());
        if ($existName === true) {
            throw new BookStoreException('Книжка з таким імям уже існує', 256);
        }
        $existYear = $this->bookRepository->existByYear($data->getYear());
        if ($existYear === true) {
            throw new BookStoreElseException('книжка з таким роком уже існує', 5555);
        }
        $bookId = $this->bookRepository->store($data);
        $this->messenger->send('book created');
        $book = $this->bookRepository->getById($bookId);
        $userId = 5;
        BookCreated::dispatch($book, $userId);

        return $book;
    }
}
