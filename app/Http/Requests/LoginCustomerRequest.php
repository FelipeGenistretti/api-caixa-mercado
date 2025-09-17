<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // permite que o request seja executado
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required','confirmed', 'string', 'min:6'],
        ];
    }

    /**
     * Mensagens de erro personalizadas (opcional)
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'O campo email é obrigatório.',
            'email.email'       => 'Informe um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min'      => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
