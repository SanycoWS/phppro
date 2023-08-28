<?php

use App\Services\Example\MultipleRoute\MultipleRouteService;
use App\Services\Example\SingleRoute\SingleRouteService;
use Illuminate\Pipeline\Pipeline;

class CategoryCreatedListener
{
    protected const HANDLERS = [
        SingleRouteService::class,
        MultipleRouteService::class,
    ];

    public function __construct(
        protected Pipeline $pipeline
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(CategoryCreated $event): void
    {
        $this->pipeline
            ->send($event)
            ->through(self::HANDLERS)
            ->then();
    }

}
