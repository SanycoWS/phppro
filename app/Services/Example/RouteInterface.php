<?php

namespace App\Services\Example;

interface RouteInterface
{
    public function handle(CategoryCreated $event, \Closure $next): CategoryCreated;
}
