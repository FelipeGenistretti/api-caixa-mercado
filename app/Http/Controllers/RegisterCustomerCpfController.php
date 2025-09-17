<?php

namespace App\Http\Controllers;

use App\Factories\MakeRegisterCustomerCpfService;
use App\Http\Requests\RegisterCustomerCpfRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RegisterCustomerCpfController extends Controller
{
    public function store(RegisterCustomerCpfRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $registerCustomerService = MakeRegisterCustomerCpfService::make();
            $customer = $registerCustomerService->execute($data);

            return response()->json([
                'message' => 'cliente registrado com sucesso!',
                'customer'    =>  $customer
            ], 201);

        } catch (Throwable $e) {
            return response()->json([
                'error'   => 'Erro ao registrar a cliente',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
