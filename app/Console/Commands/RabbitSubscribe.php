<?php

namespace App\Console\Commands;

use App\Services\Rabbit\Subscribe\CategoryCreateConsumer;
use Illuminate\Console\Command;

class RabbitSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CategoryCreateConsumer $consumer)
    {
        $consumer->handle();
    }
}
