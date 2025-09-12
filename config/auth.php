<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Define o guard e broker padrão de autenticação.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Defina aqui todos os guards da aplicação. Cada guard utiliza
    | um provider para buscar os usuários no banco de dados.
    |
    | Drivers suportados: "session", "token", "sanctum"
    |
    */

    'guards' => [
        // Guard padrão do Laravel para web (sessão)
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Guard para usuários (admins/operadores) via API
        'user' => [
            'driver' => 'sanctum',
            'provider' => 'users',
        ],

        // Guard para clientes (customers) via API
        'customer' => [
            'driver' => 'sanctum',
            'provider' => 'customers',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Define como os usuários serão buscados no banco.
    | Normalmente usamos Eloquent (model).
    |
    */

    'providers' => [
        // Provider para User (admins/operadores)
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Provider para Customer (clientes finais)
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],

        // Exemplo de provider usando query direta (opcional)
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configurações de reset de senha para cada provider.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'customers' => [
            'provider' => 'customers',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Tempo (em segundos) até expirar a confirmação de senha.
    | Padrão: 3 horas (10800 segundos).
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
