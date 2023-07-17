<?php

namespace App\Repositories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExampleRepository
{

    public function laravelChunkById()
    {
        DB::table('users')->where('active', false)
            ->chunkById(100, function (Collection $users) {
                foreach ($users as $user) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['active' => true]);
                }
            });
    }

    public function customChunkById()
    {
        $lastId = 0;
        $hasResult = true;
        while ($hasResult) {
            $users = DB::table('users')
                ->where('active', false)
                ->limit(100)
                ->where('id', '>', $lastId)
                ->get();
            foreach ($users as $user) {
                $lastId = $user->id;
            }
            if ($users->count() === 0) {
                $hasResult = false;
            }
        }
    }

    public function test(Faker $faker)
    {
        for ($i = 2; $i < 10; $i++) {
            $faker->name();
        }
    }
}
