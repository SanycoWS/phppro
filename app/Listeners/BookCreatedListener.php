<?php

namespace App\Listeners;

use App\Events\BookCreated;
use Illuminate\Support\Facades\Log;

class BookCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookCreated $event): void
    {
        $book = $event->bookIterator;
        Log::info('BookCreatedListener' . $book->getId());
    }
}
