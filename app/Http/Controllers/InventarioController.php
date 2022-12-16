<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    { 
     $inventarios = $this->listar();
    
     // return $consulta;
      return view("inventario/index",['inventarios'=>$inventarios]) ;
    
   }
  
   public function listar()
   {
    $inventarios=DB::table('inventarios as i')
        ->join('productos as p','i.producto_id','=','p.id')
        ->select('i.id as idinventario','i.stock as stock','i.ubicacion as ubicacion','p.producto as producto')
        ->where('i.estado','=','1')
        ->where('p.estado','=','1')->get() ;
      
    return $inventarios;
   }
   
   public function create(){
    $productos = DB::table('productos as p')
    ->leftjoin('inventarios as i','i.producto_id','=','p.id')
    ->select('p.id as id','p.producto as producto')
    ->where('i.producto_id','=',null)
    ->where('p.estado','=','1')->get() ;
     return view("inventario/create",['productos'=>$productos]);
   }
  
   public function store(Request $request)
   { 
     //Regla de validación
       $rules = [
            
            'stock' => 'required',
            'ubicacion' => 'required|string|max:100',
            'producto_id' => 'required'
            
          
       ];
       //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
       $validator = Validator::make($request->all(), $rules);
       //Si falla la validacion retornamos los errores
       if ($validator->fails()) {
           return $validator->errors();
       }
       //Instancia modelo Gender
       $inventario = new Inventario;
       //Llevanos el modelo con los datos del Request
       $inventario->stock = $request->stock;
       $inventario->ubicacion = $request->ubicacion;
       $inventario->producto_id = $request->producto_id;
       $inventario->estado = 1;
       //Guardamos
       if ($inventario->save()) {
          $respuesta =  1;
            return redirect('inventario/index')->with('respuesta', $respuesta);    
       } else {
         $respuesta = -1;
        return redirect('inventario/index')->with('respuesta', $respuesta);  
           
       }
   }

    
    public function show($id)
    {
        $inventario=DB::table('inventarios as i')
        ->join('productos as p','i.producto_id','=','p.id')
        ->select('i.stock','i.ubicacion','p.producto')
        ->where('i.id','=',$id)->first() ;
        
            return  $inventario ;
        

    }

    public function edit($id){
        $inventario = Inventario::find($id); 
        $productos = Producto::all();
        return view('inventario/edit',['inventario'=>$inventario,'productos'=>$productos]);
    }
    
    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'stock' => 'required|string',
            'ubicacion' => 'required|string|max:100'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $inventario = Inventario::find($id);

        if ($inventario) {
            //Cambiamos el nombre del registro con el valor enviado por Request
             
            $inventario->stock = $request->stock;
            $inventario->ubicacion = $request->ubicacion;
            
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($inventario->update()) {
                 $respuesta =  2;
           return redirect('inventario/index')->with('respuesta', $respuesta);    
            } else {
                 $respuesta =  -2;
                return redirect('inventario/index')->with('respuesta', $respuesta);    
            }
        } else {
             $respuesta =  -5;
            return redirect('inventario/index')->with('respuesta', $respuesta);    
        }
    }

    
    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $inventario = Inventario::find($id);
        if ($inventario) {
          
            $inventario->estado = 0;
                if ($inventario->update()) {
                    
                $respuesta =  3;
                 return redirect('inventario/index')->with('respuesta', $respuesta);  
                } else {
                 $respuesta =  -3;
                 return redirect('inventario/index')->with('respuesta', $respuesta);   }
            
        } else {
             $respuesta =  -5;
             return redirect('inventario/index')->with('respuesta', $respuesta);  }
    }
}
