<?php

namespace App\Services\Payments;

use App\Services\Payments\DTO\MakePaymentDTO;

interface PaymentsInterface
{

    public function makePayment(MakePaymentDTO $paymentDTO): bool;
}
