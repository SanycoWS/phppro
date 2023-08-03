<?php

namespace App\Repositories\Payments;

use Illuminate\Support\Facades\DB;

class PaymentResultRepository
{

    // TODO use DTO
    public function store()
    {
        DB::table('order_payment_result')->insert([

        ]);
    }
}
