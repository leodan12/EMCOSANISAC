<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use Illuminate\Support\Facades\Hash ;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login (Request $request){
        $this->validateLogin($request);
        if(Auth::attempt($request->only('email','password'))){
            return response()->json([
                'token'=>$request->user()->createToken('auth_token')->plainTextToken,
                'message'=>'Success'
            ],200);
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ],401);
    }

    public function validateLogin (Request $request){
        return $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);
    }

    public function register(Request $request){

        $users =User::all();

        //se valida la información que viene en $request
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80|email',
            'password' => 'required|string|min:7'
        ]);
        $emailduplicado=0;
        for($i=0;$i<count($users);$i++){
            if($users[$i]->email == $validatedData['email']){
             $emailduplicado=1;   
            }
        }
        if($emailduplicado == 0){
        //se crea el usuario en la base de datos
         $user = User::create([
             'name' => $validatedData['name'],
             'email' => $validatedData['email'],
             'password' => Hash::make($validatedData['password']),
             'rol_id' => 4,
             'estado'=> 1
         ]);
       
     
        //se crea token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //se devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ],200);
    }
    else{
        return response()->json([ 
            'message' => 'Email Duplicado'
        ],409);
    }

    }

}
