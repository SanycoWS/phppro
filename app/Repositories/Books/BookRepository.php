<?php

namespace App\Repositories\Books;

use App\Models\Book;
use App\Repositories\Books\Iterators\BookIterator;
use App\Repositories\Books\Iterators\BooksIterator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookRepository
{

    public function store(BookStoreDTO $data): int
    {
        return DB::table('books')
            ->insertGetId([
                'name' => $data->getName(),
                'year' => $data->getYear(),
                'lang' => $data->getLang(),
                'created_at' => $data->getCreatedAt(),
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
            /**
             * select books.id, books.name, a.name, a.id
             * from books
             * inner join categories c on books.category_id = c.id
             * inner join author_book ab on books.id = ab.book_id
             * inner join authors a on ab.author_id = a.id
             */
            ->orderBy('books.id')
            ->limit(20)
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
