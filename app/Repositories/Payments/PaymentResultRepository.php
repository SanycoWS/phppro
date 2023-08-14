<?php

namespace App\Repositories\Payments;

use Illuminate\Support\Facades\DB;
use Sanycows\PaymentsApi\Enums\Status;
use Sanycows\PaymentsApi\Payments\DTO\PaymentInfoDTO;

class PaymentResultRepository
{

    // TODO use DTO
    public function store(PaymentInfoDTO $DTO)
    {
        DB::table('order_payment_result')->insert([
            'user_id' => 1,
            'payment_system' => $DTO->getPaymentSystem()->value,
            'order_id' => $DTO->getOrderId(),
            'payment_id' => $DTO->getPaymentId(),
            'success' => $DTO->getStatus() === Status::SUCCESS,
            'amount' => $DTO->getAmount(),
            'currency' => $DTO->getCurrency()->value,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
