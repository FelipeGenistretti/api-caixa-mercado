<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
    
        try{
           $validatedData = $request->validate([
                'name'=>'required|string|max:100',
                'email'=>'required|email',
                'password'=>'required|string|min:8|confirmed',
                'password_confirmation'=>'required|string|min:8'

            ]);
            $user = User::create([
                'name'=>$validatedData['name'],
                'email'=>$validatedData['email'],
                'password'=>bcrypt($validatedData['password'])
            ]);
            
         
            $token = $user->createToken('auth_token')->plaintextToken;

            

            return response()->json([
                'message'=>'Usuario criado com sucesso!!',
                'token'=>$token
            ]);


        }catch(\Exception $e){
            return response()->json([
                'message'=>'Erro ao registrar usuario',
                'error'=>$e->getMessage(),
          
            ]);
        }
    }
}
