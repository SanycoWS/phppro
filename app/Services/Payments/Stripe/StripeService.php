<?php

namespace App\Services\Payments\Stripe;

use App\Enums\Currency;
use App\Services\Payments\DTO\MakePaymentDTO;
use App\Services\Payments\PaymentsInterface;
use Stripe\StripeClient;

class StripeService implements PaymentsInterface
{

    public function __construct(
        protected StripeClient $stripe
    ) {
    }

    public function makePayment(MakePaymentDTO $paymentDTO): bool
    {
        $result = $this->stripe->charges->create([
            'amount' => $paymentDTO->getAmount() * 100,
            'currency' => $this->getCurrency($paymentDTO->getCurrency()),
            'source' => 'tok_mastercard',
            'description' => $paymentDTO->getDescription(),
        ]);

        return $result->status === 'succeeded';
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'usd',
            Currency::EUR => 'eur',
        };
    }
}
