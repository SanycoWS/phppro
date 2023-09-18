<?php

namespace App\Services\BookByCommand;

use App\Repositories\Books\BookUpdateDTO;
use App\Repositories\Books\Iterators\BookIterator;
use App\Services\Books\BooksService;
use GuzzleHttp\Client;

class BookSelectAndUpdateService
{

    public function __construct(
        protected Client $client,
        protected BooksService $booksService
    ) {
    }

    public function handle()
    {
        $id = 1;
        while (true) {
            $books = $this->booksService->getAllDataIterator($id);
            /** @var BookIterator $book */
            foreach ($books as $book) {
                $dto = new BookUpdateDTO(
                    $book->getId(),
                    rand(1, 999),
                    rand(1, 999)
                );
                $this->booksService->update($dto);
                $id = $book->getId();
                echo 'UPDATE BOOK' . $id . PHP_EOL;
            }
        }
    }
}
