<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\PaymentConfirmRequest;
use App\Services\Payments\ConfirmPayment\ConfirmPaymentService;
use OpenApi\Attributes as OA;
use Sanycows\PaymentsApi\Enums\Currency;
use Sanycows\PaymentsApi\Enums\Payments;
use Sanycows\PaymentsApi\Payments\DTO\MakePaymentDTO;
use Sanycows\PaymentsApi\Payments\PaymentFactory;

class PaymentController extends Controller
{

    public function __construct(
        protected PaymentFactory $paymentFactory
    ) {
    }

    #[OA\Get(
        path: '/createPayment',
        tags: ['payment'],
        parameters: [
            new OA\Parameter(
                name: 'system',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    description: 'Access token',
                    type: 'int',
                )
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'show all books',
                content: null
            ),

        ]
    )]
    public function createPayment(int $system)
    {
        $paymentService = $this->paymentFactory->getInstance(
            Payments::from($system),
            config('payments_api')
        );
        $makePaymentDTO = new MakePaymentDTO(
            15.25,
            Currency::USD
        );
        $orderId = $paymentService->cratePayment($makePaymentDTO);

        return response()->json([
            'order' => [
                'id' => $orderId,
                'sig' => '' // ToDo for liqpay
            ],
        ]);
    }

    //ToDo ConfirmPaymentService тимчасове рішення
    public function confirmPayment(
        PaymentConfirmRequest $request,
        ConfirmPaymentService $confirmPaymentService,
        int $system
    ) {
        $data = $request->validated();

        $result = $confirmPaymentService->handle(Payments::from($system), $data['paymentId']);

        return response()->json([
            'status' => $result->isPaymentSuccess(),
        ]);
        // save to DB to table order_payment_result result

        // add to user plan

        // send to user payment result
    }
}
