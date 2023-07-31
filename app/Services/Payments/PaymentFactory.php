<?php

namespace App\Services\Payments;

use App\Enums\Payments;
use App\Services\Payments\Liqpay\LiqpayService;
use App\Services\Payments\Paypal\PaypalService;
use App\Services\Payments\Stripe\StripeService;

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
