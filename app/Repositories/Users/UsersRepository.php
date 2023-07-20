<?php

namespace App\Repositories\Users;

use App\Repositories\Users\Itterators\UserIterator;
use Illuminate\Support\Facades\DB;

class UsersRepository
{

    public function getById(int $id): UserIterator
    {
        return new UserIterator(
            DB::table('users')
                ->where('id', '=', $id)
                ->first()
        );
    }
}
