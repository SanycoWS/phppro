<?php

namespace App\Services\Payments\ConfirmPayment\Hendlers;

use App\Services\Payments\ConfirmPayment\ConfirmPaymentDTO;
use App\Services\Payments\ConfirmPayment\ConfirmPaymentInterface;
use Closure;
use Sanycows\PaymentsApi\Enums\Status;
use Sanycows\PaymentsApi\Payments\PaymentFactory;

class CheckPaymentResultHandler implements ConfirmPaymentInterface
{
    public function __construct(
        protected PaymentFactory $paymentFactory
    ) {
    }

    public function handle(ConfirmPaymentDTO $confirmPaymentDTO, Closure $next): ConfirmPaymentDTO
    {
        $paymentService = $this->paymentFactory->getInstance(
            $confirmPaymentDTO->getPayments(),
            config('payments_api')
        );

        $paymentInfo = $paymentService->getPaymentInfo($confirmPaymentDTO->getPaymentId());

        $confirmPaymentDTO->setPaymentSuccess($paymentInfo->getStatus() === Status::SUCCESS);
        $confirmPaymentDTO->setPaymentInfo($paymentInfo);

        return $next($confirmPaymentDTO);
    }
}
