<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProblemCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:problem-code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $book_id = $repository->store($storeData);
    }
}
