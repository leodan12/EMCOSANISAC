<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Venta;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Detalleventa;
use App\Models\Inventario;

class PdfController extends Controller
{
   
    public function createPDF(){
        //Recuperar todos los productos de la db
        //$productos = Producto::all();
       // view()->share('productos', $productos);
        $pdf = PDF::loadView('pdf/miboleta'   );
        return $pdf->stream('archivo-pdf.pdf');
    }

    public function boletaventa($id){
        $venta=DB::table('ventas as v')
        ->join('detalleventas as dv','dv.venta_id','=','v.id')
        ->join('inventarios as i','dv.inventario_id','=','i.id')
        ->join('productos as p','i.producto_id','=','p.id')
        ->join('clientes as cli','v.cliente_id','=','cli.id')
        ->join('users as u','v.usuario_id','=','u.id')
        ->select(  'v.id as idventa','v.fecha','v.costoventa','v.descripcion','v.estadoventa','v.costoventa',
        'cli.nombres','cli.apellidos','cli.tipodocumento','cli.numerodocumento','cli.direccion',
        'u.name as usuario','u.id as idusuario',
        'dv.cantidad','dv.preciounidad','dv.descuento','dv.preciototal','dv.id as iddetalleventa',
        'p.producto')
        ->where('cli.estado','=','1')
        ->where('dv.estado','=','1')
        ->where('v.id','=',$id)->get() ;

            //return  $venta ;
 
        //$venta2 =Detalleventa::all();
       // view()->share('venta', $venta);
        $pdf = PDF::loadView('pdf/boletaventa' ,["venta"=> $venta] );
        return $pdf->stream('archivo-pdf.pdf');
        
    }

}
