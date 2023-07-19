<?php

namespace App\Providers;

use App\Services\Books\BookStoreService;
use App\Services\Messenger\MessengerInterface;
use App\Services\Messenger\TelegramMessenger\TelegramMessengerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->when(BookStoreService::class)
            ->needs(MessengerInterface::class)
            ->give(function () {
                return $this->app->make(TelegramMessengerService::class);
            });
    }
}
