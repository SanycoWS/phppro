<?php

namespace App\Services\Payments\Factory\Liqpay;

use App\Services\Payments\Factory\DTO\MakePaymentDTO;
use App\Services\Payments\Factory\PaymentsInterface;

class LiqpayService implements PaymentsInterface
{

    public function validatePayment(string $paymentId): bool
    {
        // TODO: Implement makePayment() method.
    }

    public function cratePayment(MakePaymentDTO $paymentDTO): string
    {
        // TODO: Implement cratePayment() method.
    }
}
