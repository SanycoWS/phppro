<?php

namespace App\Console\Commands;

use App\Services\BookByCommand\BookCreateService;
use Illuminate\Console\Command;

class CreateBookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-book-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(BookCreateService $bookCreateService)
    {
        while (true) {
            $bookCreateService->handle();
        }
    }
}
