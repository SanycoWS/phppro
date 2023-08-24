<?php

namespace App\Repositories\Books;

use App\Models\Book;
use App\Repositories\Books\Iterators\BookIterator;
use App\Repositories\Books\Iterators\BooksIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookRepository
{

    public function store(BookStoreDTO $data): int
    {
        return DB::table('books')
            ->insertGetId([
                'name' => $data->getName(),
                'year' => $data->getYear(),
                'lang' => $data->getLang(),
                'category_id' => 1,
                'created_at' => $data->getCreatedAt(),
                'date' => $data->getCreatedAt(),
            ]);
    }

    public function update(BookUpdateDTO $data)
    {
    }

    public function delete(int $id): int
    {
        return DB::table('books')
            ->where('id', '=', $id)
            ->delete();
    }

    public function getAllDataIterator(int $lastId = 0): BooksIterator
    {
        $seconds = 60;
        Log::info('get data from cache');
        $result = Cache::remember('books_' . $lastId, $seconds, function () use ($lastId) {
            Log::info('cache empty');
            Log::info('execute sql query');

            return DB::table('books')
                ->select([
                    'books.id',
                    'books.name',
                    'year',
                    'books.created_at',
                    'category_id',
                    'categories.name as category_name',
                ])
                ->join('categories', 'categories.id', '=', 'books.category_id')
//                ->join('author_book', 'author_book.id', '=', 'books.id')
//                ->join('authors', 'author_book.author_id', '=', 'authors.id')
                /**
                 * select books.id, books.name, a.name, a.id
                 * from books
                 * inner join categories c on books.category_id = c.id
                 * inner join author_book ab on books.id = ab.book_id
                 * inner join authors a on ab.author_id = a.id
                 */
                ->orderBy('books.id')
                ->limit(2)
                ->where('books.id', '>', $lastId)
                ->get();
        });

        return new BooksIterator($result);
    }

    public function getAllDataIteratorNoCache(int $lastId = 0): BooksIterator
    {
        $result = DB::table('books')
            ->select([
                'books.id',
                'books.name',
                'year',
                'books.created_at',
                'category_id',
                'categories.name as category_name',
            ])
            ->join('categories', 'categories.id', '=', 'books.category_id')
//                ->join('author_book', 'author_book.id', '=', 'books.id')
//                ->join('authors', 'author_book.author_id', '=', 'authors.id')
            /**
             * select books.id, books.name, a.name, a.id
             * from books
             * inner join categories c on books.category_id = c.id
             * inner join author_book ab on books.id = ab.book_id
             * inner join authors a on ab.author_id = a.id
             */
            ->orderBy('books.id')
            ->limit(2)
            ->where('books.id', '>', $lastId)
            ->get();

        return new BooksIterator($result);
    }

    public function getAllDataModel(int $lastId = 0): Collection
    {
        return Book::query()
            ->with(['category', 'authors'])
            ->orderBy('books.id')
            ->limit(20)
            ->where('books.id', '>', $lastId)
            ->get();
    }

    public function getAllData(int $lastId = 0): Collection
    {
        $result = DB::table('books')
            ->select([
                'books.id',
                'books.name',
                'year',
                'books.created_at',
                'category_id',
                'categories.name as category_name',
            ])
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->orderBy('books.id')
            ->limit(20)
            ->where('books.id', '>', $lastId)
            ->get();

        return $result->map(function ($item) {
            return new BookIterator($item);
        });
    }

    public function getById(int $id): BookIterator
    {
        return new BookIterator(
            DB::table('books')
                ->select([
                    'id',
                    'name',
                    'year',
                    'created_at',
                ])
                ->where('id', '=', $id)
                ->first()
        );
    }
}
