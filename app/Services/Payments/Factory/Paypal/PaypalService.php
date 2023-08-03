<?php

namespace App\Services\Payments\Factory\Paypal;

use App\Enums\Currency;
use App\Services\Payments\Factory\DTO\MakePaymentDTO;
use App\Services\Payments\Factory\PaymentsInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalService implements PaymentsInterface
{
    public function __construct(
        protected PayPalClient $payPalClient
    ) {
    }

    public function validatePayment(string $paymentId): bool
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->capturePaymentOrder($paymentId);

        return $response['status'] === 'COMPLETED';
    }

    private function getCurrency(Currency $currency): string
    {
        return match ($currency) {
            Currency::USD => 'USD',
            Currency::EUR => 'EUR',
        };
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        $this->payPalClient->setApiCredentials(config('paypal'));
        $paypalToken = $this->payPalClient->getAccessToken();
        $response = $this->payPalClient->createOrder([
            "intent" => "CAPTURE",
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
            return $response['id'];
        }

        return '';
    }
}
