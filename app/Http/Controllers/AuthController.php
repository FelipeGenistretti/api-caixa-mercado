<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try{
            $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário criado com sucesso!',
            'token' => $token,
        ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message' => 'Erro ao criar usuário',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request){

        try{
            $credenciais = $request->validate([
                'email'=> 'required',
                'password'=>'required'
            ]);
    
    
         if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        $user = User::where('email',$request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'token' => $token,
        ], 200);
    }
        catch(\Exception $e){
            return response()->json([
                'message'=> 'Erro ao realizar o login',
                'Erro'=> $e->getMessage()
            ], 500);
        }
      


    }


}
