<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCustomerCpfRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "cpf"   => ['required', 'string', 'size:11', 'regex:/^[0-9]+$/'],
            "name"  => ['required', 'string', 'max:255'],
            "phone" => ['nullable', 'string', 'max:20'],
            "cnpj"  => ['nullable', 'string', 'size:14', 'regex:/^[0-9]+$/'],
            "email" => [
                'nullable',
                'string',
                'email',
                Rule::unique('customers', 'email')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.size'     => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.regex'    => 'O CPF deve conter apenas números.',
            'email.email'  => 'Informe um email válido.',
            'email.unique' => 'Esse email já está cadastrado.',
        ];
    }
}
