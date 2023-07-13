<?php

namespace App\Repositories\Books;

use App\Repositories\Books\Iterators\BookIterator;
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

    public function update(BookStoreDTO $data)
    {
    }

    public function delete(int $id): int
    {
        return DB::table('books')
            ->where('id', '=', $id)
            ->delete();
    }

    public function getAllData()
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
