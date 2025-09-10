<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request){
         
        //Valida os dados
       
        try{
             $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'password_confirmation'=>'required|string|min:8',
        ]);

          $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        }catch(\Exception $e){
            return response()->json(['message'=>'Erro ao registrar usuario','error'=>$e->getMessage()],500);
        }
       
        
        //CRIA O USUARIO    
      

        $token = $user->createToken('api_token')->plainTextToken;

       return response()->json([
        'user'=>$user,
       'token'=>$token
       ],201);

    }
}
