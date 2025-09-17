<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite que qualquer usuário faça o request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                'max:255',
                Rule::unique('customers', 'email') // garante que seja único na tabela customers
            ],
            'password' => ['required', 'string', Password::min(6)],

            'cpf'      => ['nullable', 'string', 'max:14'], // pode adicionar regex se quiser
            'cnpj'     => ['nullable', 'string', 'max:18'], // pode adicionar regex se quiser
            'phone'    => ['nullable', 'string', 'max:20'],
        ];
    }
}
