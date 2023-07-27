<?php

namespace App\Repositories\LastActivity;

use Illuminate\Support\Facades\DB;

class LastActivityRepository
{

    public function store(int $userId, string $ip): void
    {
        DB::table('last_activity')
            ->insert([
                'user_id' => $userId,
                'ip' => $ip,
                'created_at' => now(),
            ]);
    }
}
