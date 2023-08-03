<?php

namespace App\Services\Payments\ConfirmPayment\Hendlers;

use App\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use App\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use App\Services\Payments\Factory\PaymentFactory;
use Closure;

class CheckPaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentFactory $paymentFactory
    ) {
    }

    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next): ConfirmPaymentDTO
    {
        $paymentService = $this->paymentFactory->getInstance(
            $confirmPaymentDTO->getPayments()
        );

        $success = $paymentService->validatePayment($confirmPaymentDTO->getPaymentId());

        $confirmPaymentDTO->setPaymentSuccess($success);

        return $next($confirmPaymentDTO);
    }
}
