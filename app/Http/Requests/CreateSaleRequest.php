<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required','exists:customers,id'],
            'payment_type'=> ['required','string','in:dinheiro,cartao,pix,cheque'],
            'items'=> ['required','array','min:1'],
            'items.*.code_bar'=> ['required','string','exists:products,code_bar'],
            'items.*.quantity' => ['required','integer','min:1'],
        ];
    }
}
