<?php

namespace App\Services\Payments\ConfirmPayment;

use App\Services\Payments\ConfirmPayment\Hendlers\CheckPaymentResultHandler;
use App\Services\Payments\ConfirmPayment\Hendlers\SavePaymentResultHandler;
use Illuminate\Pipeline\Pipeline;
use Sanycows\PaymentsApi\Enums\Payments;

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

    public function handle(Payments $payments, string $paymentId): ConfirmPaymentDTO
    {
        $dto = new ConfirmPaymentDTO($payments, $paymentId);

        return $this->pipeline
            ->send($dto)
            ->through(self::HANDLERS)
            ->then(function (ConfirmPaymentDTO $DTO) {
                return $DTO;
            });
    }
}
