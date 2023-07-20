<?php

namespace App\Repositories;

use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ExampleRepository
{

    public function laravelChunkById()
    {
        DB::table('users')
            ->select([
                'id',
                'email'
            ])
            ->where('active', false)
            ->chunkById(100, function (Collection $collection) {
                $collection->last();
                foreach ($collection as $user) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['active' => true]);
                }
            });
        //
    }

    public function customChunkById()
    {
        $lastId = 0;
        $hasResult = true;
        while ($hasResult) {
            $users = DB::table('users')
                ->select([
                    'id',
                    'email'
                ])
                ->where('active', false)
                ->where('id', '>', $lastId)
                ->limit(100)
                ->get();

            $lastId = $users->last()->id;
            if ($users->count() === 0) {
                $hasResult = false;
            }
        }
        //
    }

    public function test(Faker $faker)
    {
        for ($i = 2; $i < 10; $i++) {
            $faker->name();
        }
    }
}
