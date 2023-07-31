<?php

namespace App\Http\Controllers;

use App\Enums\Payments;
use App\Http\Requests\Payment\PaymentMakeRequest;
use App\Services\Payments\DTO\MakePaymentDTO;
use App\Services\Payments\PaymentFactory;

class PaymentController extends Controller
{

    public function __construct(
        protected PaymentFactory $paymentFactory
    ) {
    }

    public function makePayment(PaymentMakeRequest $request)
    {
        $makePaymentDTO = new MakePaymentDTO(...$request->validated());
        $paymentService = $this->paymentFactory->getInstance(Payments::from((int)$request->validated('paymentSystem')));

        $paymentService->makePayment($makePaymentDTO);
    }

}
