<?php

namespace App\Http\Requests\Book;

use App\Enums\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'bail', 'string', 'max:20', 'min:5'],
            'lang' => ['required', Rule::enum(Lang::class)],
            'year' => ['sometimes', 'numeric', 'integer', 'between:1970,' . date('Y')],
        ];
    }

}
