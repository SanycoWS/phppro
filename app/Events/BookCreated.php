<?php

namespace App\Events;

use App\Repositories\Books\Iterators\BookIterator;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public BookIterator $bookIterator,
        public int $userId,
    ) {
    }

}
