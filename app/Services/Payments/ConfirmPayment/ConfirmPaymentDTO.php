<?php

namespace App\Services\Payments\ConfirmPayment;

use Sanycows\PaymentsApi\Enums\Payments;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;

class ConfirmPaymentDTO
{

    protected bool $paymentSuccess;
    protected PaymentInfoDTO $paymentInfo;

    public function __construct(
        protected Payments $payments,
        protected string $paymentId
    ) {
    }

    /**
     * @return bool
     */
    public function isPaymentSuccess(): bool
    {
        return $this->paymentSuccess;
    }

    /**
     * @param bool $paymentSuccess
     */
    public function setPaymentSuccess(bool $paymentSuccess): void
    {
        $this->paymentSuccess = $paymentSuccess;
    }

    /**
     * @return Payments
     */
    public function getPayments(): Payments
    {
        return $this->payments;
    }

    /**
     * @return string
     */
    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function setPaymentInfo(PaymentInfoDTO $paymentInfo)
    {
        $this->paymentInfo = $paymentInfo;
    }

    /**
     * @return PaymentInfoDTO
     */
    public function getPaymentInfo(): PaymentInfoDTO
    {
        return $this->paymentInfo;
    }

}
