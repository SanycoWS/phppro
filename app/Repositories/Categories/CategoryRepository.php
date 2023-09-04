<?php

namespace App\Repositories\Categories;

use App\Services\Rabbit\Messages\CategoryCreateMessageDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{

    public function create(CategoryCreateMessageDTO $DTO)
    {
        DB::table('categories')->insert([
            'name' => $DTO->getName(),
            'created_at' => Carbon::createFromTimestamp($DTO->getCreatedAt()),
            'updated_at' => Carbon::createFromTimestamp($DTO->getUpdatedAt()),
        ]);
    }
}
