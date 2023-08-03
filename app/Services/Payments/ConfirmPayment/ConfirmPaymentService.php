<?php

namespace App\Services\Payments\ConfirmPayment;

use App\Enums\Payments;
use App\Services\Payments\ConfirmPayment\Hendlers\CheckPaymentResultHandler;
use App\Services\Payments\ConfirmPayment\Hendlers\SavePaymentResultHandler;
use Illuminate\Pipeline\Pipeline;

class ConfirmPaymentService
{
    const HANDLERS = [
        CheckPaymentResultHandler::class,
        SavePaymentResultHandler::class,
    ];

    public function __construct(
        protected Pipeline $pipeline
    ) {
    }

    public function handle(Payments $payments, string $paymentId)
    {
        $dto = new ConfirmPaymentDTO($payments, $paymentId);
        $result = $this->pipeline
            ->send($dto)
            ->through(self::HANDLERS)
            ->then(function (ConfirmPaymentDTO $DTO) {
                return $DTO;
            });
    }
}
