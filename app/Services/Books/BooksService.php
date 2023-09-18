<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\BookUpdateDTO;
use App\Repositories\Books\Iterators\BookIterator;
use App\Repositories\Books\Iterators\BooksIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

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

    public function update(BookUpdateDTO $bookUpdateDTO)
    {
        $this->bookRepository->update($bookUpdateDTO);
    }

    public function delete(): void
    {
        $this->bookRepository->delete(1);
    }

    public function getAllDataIterator(int $lastId): BooksIterator
    {
        return $this->bookRepository->getAllDataIterator($lastId);
    }

    public function getAllDataIteratorNoCache(int $lastId): BooksIterator
    {
        $seconds = 60;

        return Cache::remember('books_' . $lastId, $seconds, function () use ($lastId) {
            return $this->bookRepository->getAllDataIteratorNoCache($lastId);
        });
    }

    public function getAllData(int $lastId): Collection
    {
        $data = $this->bookRepository->getAllData($lastId);

        return $data;
    }

    public function getAllDataModel(int $lastId, int|float $limit = 100): Collection
    {
        $data = $this->bookRepository->getAllDataModel($lastId);

        return $data;
    }
}
