<?php

namespace App\Providers;

use App\Services\Books\BookStoreService;
use App\Services\Messenger\MessengerInterface;
use App\Services\Messenger\TelegramMessenger\TelegramMessengerService;
use App\Services\Payments\Factory\Stripe\StripeService;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

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

        $this->app->when(StripeService::class)
            ->needs(StripeClient::class)
            ->give(function () {
                return new StripeClient(config('stripe.api_keys.secret_key'));
            });
    }
}
