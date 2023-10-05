<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FillOldBooksDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill_old_books_data';

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
        /**
         * $lastId = (int)Redis::get
         * $DATA = select * from books by limit 1000 where id<$lastId
         * check count messages in consumer
         * set to redis lastId
         * $DATA send to rabbit
         * create consumer = inserts into books_with_new_column
         *
         * rename books to books_old;
         * rename books_with_new_column to books;
         */
    }
}
