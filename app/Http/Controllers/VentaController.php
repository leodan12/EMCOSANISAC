<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Detalleventa;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
   {
    //$ventas = venta::all();
    $ventas = $this->listar();
     
    // return $ventas;
      return view("venta/index",['ventas'=>$ventas ]) ;
    
   }
  
   public function listar()
   {
    $ventas=DB::table('ventas as v')
        ->join('clientes as c','v.cliente_id','=','c.id')
        ->join('users as u','v.usuario_id','=','u.id')
        ->select(  'v.id as idventa','v.fecha','c.nombres','c.apellidos','c.tipodocumento','c.numerodocumento','v.descripcion','v.costoventa','v.estadoventa','u.name as usuario')
        ->where('v.estado','=','1')->get() ;
      
    return $ventas;
   }
   
   public function create()
   {
    $productos=DB::table('productos as p')->join('inventarios as i','i.producto_id','=','p.id')
        
        ->select(  'i.id as idinventario','p.producto')
        ->where('p.estado','=','1')
        ->where('i.estado','=','1')->get() ;
    return $productos;
    $clientes = Cliente::all();
    return view("venta/create",['clientes'=>$clientes,'productos'=>$productos]);
   }
  
   public function store(Request $request)
   {
       //Regla de validación
       $rules = [
            'fecha' => 'required|string|max:30',
            'cliente' => 'required',
            'descripcion' => 'required|string|max:100',
            'costoventa' => 'required',
            'estadoventa' => 'required'
          
       ];
       //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
       $validator = Validator::make($request->all(), $rules);
       //Si falla la validacion retornamos los errores
       if ($validator->fails()) {
           return $validator->errors();
       }
       //Instancia modelo Gender
       $venta = new Venta;
       //Llevanos el modelo con los datos del Request
       $venta->fecha = $request->fecha;
       $venta->cliente_id = $request->cliente;
       $venta->descripcion = $request->descripcion;
       $venta->costoventa = $request->costoventa;
       $venta->estadoventa = $request->estadoventa;
       $venta->usuario_id = Auth::id();
       $venta->estado = 1;
       //Guardamos
       if ($venta->save()) {
            
            $respuesta =  1;
            $cantidad=$request->Lcantidad;
            $descuento=$request->Ldescuento;
            $preciounidad=$request->Lpreciounidad;
            $preciototal=$request->Lpreciototal;
            $inventario=$request->Linventario;

            if($inventario !== null) {
                for ($i = 0; $i < count($inventario); $i++) {
        
                    $Detalleventa = new Detalleventa;
                    $Detalleventa->cantidad = $cantidad[$i];
                    $Detalleventa->descuento = $descuento[$i];
                    $Detalleventa->preciounidad = $preciounidad[$i];
                    $Detalleventa->preciototal = $preciototal[$i];
                    $Detalleventa->venta_id = $venta->id;
                    $Detalleventa->inventario_id = $inventario[$i];
                    $Detalleventa->estado = 1;
                    $Detalleventa->save();
        
                }
            }

           return redirect('venta/index')->with('respuesta', $respuesta);
       } else {
        
        $respuesta = -1;
        return redirect('venta/index')->with('respuesta', $respuesta);
           
       }
   }

    
    public function show($id)
    {
        
        $venta=DB::table('ventas as v')
        ->join('detalleventas as dv','dv.venta_id','=','v.id')
        ->join('inventarios as i','dv.inventario_id','=','i.id')
        ->join('productos as p','i.producto_id','=','p.id')
        ->join('clientes as cli','v.cliente_id','=','cli.id')
        ->join('users as u','v.usuario_id','=','u.id')
        ->select(  'v.id as idventa','v.fecha','v.costoventa','v.descripcion','v.estadoventa',
        'cli.nombres','cli.apellidos','cli.tipodocumento','cli.numerodocumento',
        'u.name as usuario','u.id as idusuario',
        'dv.cantidad','dv.preciounidad','dv.descuento','dv.preciototal',
        'p.producto')
        ->where('cli.estado','=','1')
        ->where('dv.estado','=','1')
        ->where('v.id','=',$id)->get() ;

            return  $venta ;
        

    }

    public function edit($id)
    {
        $venta = Venta::find($id);
        $productos=DB::table('productos as p')->join('inventarios as i','i.producto_id','=','p.id')
        
        ->select(  'i.id as idinventario','p.producto')
        ->where('p.estado','=','1')
        ->where('i.estado','=','1')->get() ;

        $detallesventa=DB::table('ventas as v')
        ->join('detalleventas as dv','dv.venta_id','=','v.id')
        ->select(  'v.id as idventa','dv.id as iddetalleventa','dv.inventario_id','dv.descuento','dv.cantidad','dv.preciounidad','dv.preciototal')
        ->where('v.estado','=','1')
        ->where('dv.venta_id','=',$id)
        ->where('dv.estado','=','1')->get() ;
        $clientes = Cliente::all();
        return view('venta/edit',['venta'=>$venta,'clientes'=>$clientes,'productos'=>$productos,'detallesventa'=>$detallesventa]);
    }
    
    public function update(Request $request, $id) 
    {
        //Regla de validación
        $rules = [
            'fecha' => 'required|string|max:30',
            'cliente' => 'required',
            'descripcion' => 'required|string|max:100',
            'costoventa' => 'required',
            'estadoventa' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $venta = Venta::find($id);

        if ($venta) {
            //Cambiamos el nombre del registro con el valor enviado por Request
            $venta->fecha = $request->fecha;
            $venta->cliente_id = $request->cliente;
            $venta->descripcion = $request->descripcion;
            $venta->costoventa = $request->costoventa;
            $venta->estadoventa = $request->estadoventa;
            $venta->usuario_id = 1;
            $venta->estado = 1;
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($venta->update()) {
                
                $respuesta =  2;
                $cantidad=$request->Lcantidad;
                $descuento=$request->Ldescuento;
                $preciounidad=$request->Lpreciounidad;
                $preciototal=$request->Lpreciototal;
                $inventario=$request->Linventario;

            if($inventario !== null) {
                for ($i = 0; $i < count($inventario); $i++) {
        
                    $Detalleventa = new Detalleventa;
                    $Detalleventa->cantidad = $cantidad[$i];
                    $Detalleventa->descuento = $descuento[$i];
                    $Detalleventa->preciounidad = $preciounidad[$i];
                    $Detalleventa->preciototal = $preciototal[$i];
                    $Detalleventa->venta_id = $venta->id;
                    $Detalleventa->inventario_id = $inventario[$i];
                    $Detalleventa->estado = 1;
                    $Detalleventa->save();
        
                }
            }
           return redirect('venta/index')->with('respuesta', $respuesta);
            } else {
                
                $respuesta =  -2;
                return redirect('venta/index')->with('respuesta', $respuesta);
            }
        } else {
            
            $respuesta =  -5;
            return redirect('venta/index')->with('respuesta', $respuesta);
        }
    }

    
    public function destroy($id) 
    {
        //buscamos el registro con el id enviado por la URL
        $venta = Venta::find($id);
        if ($venta) {
          
            $venta->estado = 0;
                if ($venta->update()) {
                    
                $respuesta =  3;
                return redirect('venta/index')->with('respuesta', $respuesta);
                } else {
                    
                $respuesta =  -3;
                return redirect('venta/index')->with('respuesta', $respuesta);
                }
            
        } else {
            
            $respuesta =  -5;
            return redirect('venta/index')->with('respuesta', $respuesta);
        }
    }

    public function destroydetalleventa($id) 
    {
        //buscamos el registro con el id enviado por la URL
        $detalleventa = Detalleventa::find($id);
        if ($detalleventa) {
          
            $detalleventa->estado = 0;
            $detalleventa->update();
}
    }

}