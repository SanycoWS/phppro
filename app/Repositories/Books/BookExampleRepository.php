<?php

namespace App\Repositories\Books;

use App\Enums\Lang;
use App\Repositories\Books\Iterators\BookIterator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BookExampleRepository
{
    private Builder $query;

    public function __construct()
    {
        $this->query = DB::table('books');
    }

    public function index(BookIndexDTO $data): Builder
    {
        $this->query->select([
            'books.id',
            'books.name',
            'year',
            'lang',
            'books.pages',
            'books.created_at',
            'category_id',
            'categories.name as category_name'
        ])
            ->join('categories', 'categories.id', '=', 'books.category_id')
            ->orderBy('books.id')
            ->limit(10)
            ->where('books.id', '>', $data->getLastId());

        return $this->query;
    }

    public function filterByYear(int $year): Builder
    {
        return $this->query->where('year', '=', $year);
    }

    public function filterByLang(Lang $lang): Builder
    {
        return $this->query->where('lang', '=', $lang);
    }

    public function filterByCreatedAt(string $startDate, string $endDate): Builder
    {
        return $this->query->where('books.created_at', '>=', $startDate)
            ->where('books.created_at', '<=', $endDate);
    }

    public function useCreatedAtIndex(): Builder
    {
        return $this->query->useIndex('books_created_at_index');
    }

    public function useYearCreatedAtIndex(): Builder
    {
        return $this->query->useIndex('books_year_created_at_index');
    }

    public function useLangCreatedAtIndex(): Builder
    {
        return $this->query->useIndex('books_lang_created_at_index');
    }

    public function useYearLangCreatedAtIndex(): Builder
    {
        return $this->query->useIndex('books_year_lang_created_at_index');
    }

    public function getData()
    {
        $collection = $this->query->get();

        return $collection->map(function ($book) {
            return new BookIterator($book);
        });
    }
}
