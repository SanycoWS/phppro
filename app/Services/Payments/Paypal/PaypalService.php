<?php

namespace App\Services\Payments\Paypal;

use App\Enums\Currency;
use App\Services\Payments\DTO\MakePaymentDTO;
use App\Services\Payments\PaymentsInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalService implements PaymentsInterface
{
    public function __construct(
        protected PayPalClient $payPalClient
    ) {
    }

    public function makePayment(MakePaymentDTO $paymentDTO): bool
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $this->getCurrency($paymentDTO->getCurrency()),
                        "value" => number_format($paymentDTO->getAmount(), 2, '.')
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            return true;
        }

        return false;
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'USD',
            Currency::EUR => 'EUR',
        };
    }
}
