<?php

namespace App\Services\Payments\ConfirmPayment;

use App\Enums\Payments;

class ConfirmPaymentDTO
{

    protected bool $paymentSuccess;

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

}
