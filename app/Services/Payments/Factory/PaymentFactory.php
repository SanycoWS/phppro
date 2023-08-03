<?php

namespace App\Services\Payments\Factory;

use App\Enums\Payments;
use App\Services\Payments\Factory\Liqpay\LiqpayService;
use App\Services\Payments\Factory\Paypal\PaypalService;
use App\Services\Payments\Factory\Stripe\StripeService;

class PaymentFactory
{

    public function getInstance(Payments $payments): PaymentsInterface
    {
        return match ($payments) {
            Payments::PAYPAL => app()->make(PaypalService::class),
            Payments::STRIPE => app()->make(StripeService::class),
            Payments::LIQPAY => app()->make(LiqpayService::class),
        };
    }
}
