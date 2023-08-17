<?php

namespace App\Services\Books;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\BookStoreDTO;
use App\Repositories\Books\Iterators\BookIterator;
use App\Repositories\Books\Iterators\BooksIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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
        Redis::set('my_new_key_lastId', $lastId, 'EX', 60);
        Redis::get('my_new_key_lastId');

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

    public function getAllDataModel(int $lastId): Collection
    {
        $data = $this->bookRepository->getAllDataModel($lastId);

        return $data;
    }
}
