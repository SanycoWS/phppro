<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\Iterators\BookIterator;
use App\Repositories\Books\Iterators\BooksIterator;
use Illuminate\Support\Collection;

class BooksService
{

    public function __construct(
        protected BookRepository $bookRepository
    ) {
    }

    public function store(BookStoreDTO $data): BookIterator
    {
        $bookId = $this->bookRepository->store($data);

        $book = $this->bookRepository->getById($bookId);

        return $book;
    }

    public function update()
    {
        $this->bookRepository->update();
    }

    public function delete(): void
    {
        $this->bookRepository->delete(1);
    }

    public function getAllDataIterator(int $lastId): BooksIterator
    {
        return $this->bookRepository->getAllDataIterator($lastId);
    }

    public function getAllData(int $lastId): Collection
    {
        $data = $this->bookRepository->getAllData($lastId);

        return $data;
    }

    public function getAllDataModel(int $lastId): Collection
    {
        $data = $this->bookRepository->getAllDataModel($lastId);

        return $data;
    }
}
