<?php

namespace App\Services\Payments\Liqpay;

use App\Services\Payments\DTO\MakePaymentDTO;
use App\Services\Payments\PaymentsInterface;

class LiqpayService implements PaymentsInterface
{

    public function makePayment(MakePaymentDTO $paymentDTO): bool
    {
        // TODO: Implement makePayment() method.
    }
}
