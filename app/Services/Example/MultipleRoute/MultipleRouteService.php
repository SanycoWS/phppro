<?php

namespace App\Services\Example\MultipleRoute;

use App\Services\Example\CategoryCreated;
use App\Services\Example\Log;
use App\Services\Example\RouteInterface;

class MultipleRouteService implements RouteInterface
{
    protected const MAX_USED = 30;

    public function __construct(
        protected MultipleRouteStorage $routeStorage
    ) {
    }

    public function handle(CategoryCreated $event, \Closure $next): CategoryCreated
    {
        $value = $this->routeStorage->get($event->getUserId(),);
        if ($value === 0) {
            $this->routeStorage->set($event->getUserId(), $event->getRouteName());
        }
        if ($value > 0) {
            $this->routeStorage->incr($event->getUserId(), $event->getRouteName());
        }
        if ($value <= self::MAX_USED) {
            return $next($event);
        }
        Log::info('multiple route');

        // Todo some else
        return $next($event);
    }
}
