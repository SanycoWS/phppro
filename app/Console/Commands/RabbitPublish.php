<?php

namespace App\Console\Commands;

use App\Services\Rabbit\Publish\SendCreateCategoryService;
use Illuminate\Console\Command;

class RabbitPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rabbit-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SendCreateCategoryService $service)
    {
        while (true) {
            $service->handle();
        }
    }
}
