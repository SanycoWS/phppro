<?php

namespace App\Services\Payments\Factory;

use App\Services\Payments\Factory\DTO\MakePaymentDTO;

interface PaymentsInterface
{

    public function validatePayment(string $paymentId): bool;

    public function cratePayment(MakePaymentDTO $paymentDTO): string;
}
