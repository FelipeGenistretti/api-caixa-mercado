<?php
namespace App\Http\Controllers;

use App\Factories\MakeLoginCustomerService;
use App\Factories\MakeRegisterCustomerService;
use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\RegisterCustomerRequest;
use Illuminate\Validation\ValidationException;

class AuthCustomerController extends Controller
{
    public function login(LoginCustomerRequest $request)
    {
        try {
            $data = $request->validated();
            $loginCustomerService = MakeLoginCustomerService::make();
            $customer = $loginCustomerService->execute($data);

            $token = $customer->createToken('auth_token', ['customer'])->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $customer
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                "errors" => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ocorreu um erro ao efetuar login.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function register(RegisterCustomerRequest $request)
    {
        try {
            $data = $request->validated();
            $registerCustomerService = MakeRegisterCustomerService::make();
            $customer = $registerCustomerService->execute($data);

            $token = $customer->createToken('auth_token', ['customer'])->plainTextToken;

            return response()->json([
                "message" => "Cliente registrado com sucesso!",
                "cliente" => $customer,
                "token" => $token
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                "errors" => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Ocorreu um erro ao registrar o cliente.",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
