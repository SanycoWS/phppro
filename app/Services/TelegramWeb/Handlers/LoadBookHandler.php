<?php

namespace App\Services\TelegramWeb\Handlers;

use App\Repositories\Books\BookRepository;
use App\Repositories\Books\Iterators\BookIterator;
use App\Services\TelegramWeb\CommandsInterface;

class LoadBookHandler implements CommandsInterface
{
    public function __construct(
        protected BookRepository $bookRepository
    ) {
    }

    public function handle(string $arguments): string
    {
        $result = '';
        $books = $this->bookRepository->getAllDataIterator((int)$arguments);
        /** @var BookIterator $book */
        foreach ($books as $book) {
            $result .= 'name:' . $book->getName() . PHP_EOL;
            $result .= 'year:' . $book->getYear() . PHP_EOL;
            $result .= 'id:' . $book->getId() . PHP_EOL;
            $result .= PHP_EOL;
        }
        $result .= 'Enter last ID for load more books';

        return $result;
    }
}
