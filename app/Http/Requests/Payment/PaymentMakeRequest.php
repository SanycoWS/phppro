<?php

namespace App\Http\Requests\Payment;

use App\Enums\Currency;
use App\Enums\Payments;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentMakeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:0', 'max:9999'],
            'currency' => ['required', Rule::enum(Currency::class)],
            'paymentSystem' => ['required', Rule::enum(Payments::class)],
            'description' => ['sometimes', 'max:255'],
        ];
    }

}
