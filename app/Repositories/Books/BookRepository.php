<?php

namespace App\Repositories\Books;

use App\Repositories\Books\Iterators\BookIterator;
use Illuminate\Support\Facades\DB;

class BookRepository
{

    public function store(BookStoreDTO $data): int
    {
        return DB::table('book')
            ->insertGetId([
                'name' => $data->getName(),
                'year' => $data->getYear(),
                'created_at' => $data->getCreatedAt(),
            ]);
    }

    public function getById(int $id): BookIterator
    {
        return new BookIterator(
            DB::table('book')
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
