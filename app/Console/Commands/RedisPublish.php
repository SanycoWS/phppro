<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to a Redis channel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        while (true) {
            Redis::publish(
                'test-channel',
                json_encode([
                    'name' => 'Adam Wathan',
                    'time' => time(),
                ])
            );
            $this->info('PUBLISHED');
            sleep(5);
        }
    }
}
