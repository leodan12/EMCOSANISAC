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

class VentaController extends Controller
{
    public function listaventas($token)
    {
        $ventasusuario  = DB::table('ventas as v')
        ->join('detalleventas as dv', 'dv.venta_id', '=', 'v.id')
        ->join('inventarios as i', 'dv.inventario_id', '=', 'i.id')
        ->join('productos as p', 'i.producto_id', '=', 'p.id')
        ->join('clientes as c', 'v.cliente_id', '=', 'c.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->select('v.id' , 'v.fecha as fecha','v.costoventa',
         'v.descripcion','u.email') 
        ->distinct('v.id') 
        ->groupBy('v.costoventa',
        'v.fecha', 'v.descripcion','v.id' ,'u.email')
        ->where('u.email','=',$token)   
        ->orderBy('fecha', 'asc')
        ->get();


        return response()->json([
            'ventas' => $ventasusuario,
            'message' => 'Success'
        ], 200);

    }




}
