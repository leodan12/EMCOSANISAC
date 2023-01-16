<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $users = User::all();

        $emailE = 0;
        $passwordE = 0;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->email == $validatedData['email']) {
                $emailE = 1;
            }
        }
        if ($emailE == 1) {
            for ($i = 0; $i < count($users); $i++) {
                if ($users[$i]->password == Hash::make($validatedData['password'])) {
                    $passwordE = 1;
                }
            }
        }
 
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email','=',$validatedData['email'])->first();
            return response()->json([
                'id'=> $user->id,
                'token' => $request->user()->createToken('auth_token')->plainTextToken,
                'message' => 'Success'
            ], 200);
        } else {
            if ($emailE == 0) {
                return response()->json([
                    'message' => 'Correo No Encontrado'
                ], 404);
            } else {
                return response()->json([
                    'message' => 'Contraseña Incorrecta'
                ], 403);
            }
        }
    }

    public function register(Request $request)
    {

        $users = User::all();

        //se valida la información que viene en $request
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80|email',
            'password' => 'required|string|min:7'
        ]);
        $emailduplicado = 0;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]->email == $validatedData['email']) {
                $emailduplicado = 1;
            }
        }

        if ($emailduplicado == 0) {
            //se crea el usuario en la base de datos
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'rol_id' => 4,
                'estado' => 1
            ]);


            //se crea token de acceso personal para el usuario
            $token = $user->createToken('auth_token')->plainTextToken;
            $id=$user->id;
            //se devuelve una respuesta JSON con el token generado y el tipo de token
            return response()->json([
                'id'=>$id,
                'token' => $token,
                'message' => 'Success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Correo Duplicado'
            ], 409);
        }
    }

    public function logout(){
        //$request->user()->currentAccessToken()->delete();
       // $user->tokens()->where('id', $tokenId)->delete();
    }
}
