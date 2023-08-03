<?php

namespace App\Services\Payments\ConfirmPayment;

use Closure;

interface ConfirmPaymentInterface
{
    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next): ConfirmPaymentDTO;
}
