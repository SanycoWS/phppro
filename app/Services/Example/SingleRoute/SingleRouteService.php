<?php

namespace App\Services\Example\SingleRoute;

use App\Services\Example\CategoryCreated;
use App\Services\Example\Log;
use App\Services\Example\RouteInterface;

class SingleRouteService implements RouteInterface
{
    protected const MAX_USED = 10;

    public function __construct(
        protected SingleRouteStorage $routeStorage
    ) {
    }

    public function handle(CategoryCreated $event, \Closure $next): CategoryCreated
    {
        $value = $this->routeStorage->get($event->getUserId(), $event->getRouteName());
        if ($value === 0) {
            $this->routeStorage->set($event->getUserId(), $event->getRouteName());
        }
        if ($value > 0) {
            $this->routeStorage->incr($event->getUserId(), $event->getRouteName());
        }
        if ($value <= self::MAX_USED) {
            return $next($event);
        }
        Log::info('single route');

        // Todo some else
        return $next($event);
    }
}
