<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Venta;
use App\Models\Detalleventa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
     
    
    public function datosuser( )
    {
        $user = Auth::user();
        //$searchUser = User::where('id', $user->id)->first();
       // return $searchUser;


        $searchUser  = DB::table('users as u') 
        ->select('u.id','u.name' , 'u.email' )
        ->where('u.id','=', 1)
        ->first(); 
        //->get();

        //return $searchUser;

        return response()->json([
            'user' => $searchUser,
            'message' => 'Success'
        ], 200);

    }
     public function datosuser2( )
    {
        $user = Auth::user();
        //$searchUser = User::where('id', $user->id)->first();
       // return $searchUser;


        $searchUser  = DB::table('users as u') 
        ->select('u.id','u.name' , 'u.email' )
        ->where('u.id','=', 1)
        ->first(); 
        //->get();

        //return $searchUser;

        return response()->json([
            'user' => $searchUser,
            'message' => 'Success'
        ], 200);

    }




}
