<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function index() 
   {
    //$productos = Producto::all();
    $productos = $this->listar();
    
    // return $consulta;
      return view("producto/index",['productos'=>$productos]) ;
    
   }
  
   public function listar()
   {
    $productos=DB::table('productos as p')
        ->join('categorias as c','p.categoria_id','=','c.id')
        
        ->select(  'p.id as idproducto','p.codigo','p.producto','p.descripcion','c.categoria as categoria','p.marca','p.precio','p.peso')
        ->where('p.estado','=','1')->get() ;
      
    return $productos;
   }
   
   public function create()
   {
    $categorias = Categoria::all();
    return view("producto/create",['categorias'=>$categorias]);
   }
  
   public function store(Request $request)
   {
       //Regla de validación
       $rules = [
            'producto' => 'required|string|max:30',
            'categoria_id' => 'required|integer',
            'descripcion' => 'required|string|max:100',
            'marca' => 'required|string|max:30',
            'precio' => 'required',
            'codigo' => 'required',
            'peso' => 'required'
          
       ];
       //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
       $validator = Validator::make($request->all(), $rules);
       //Si falla la validacion retornamos los errores
       if ($validator->fails()) {
           return $validator->errors();
       }
       //Instancia modelo Gender
       $producto = new Producto;
       //Llevanos el modelo con los datos del Request
       $producto->producto = $request->producto;
       $producto->categoria_id = $request->categoria_id;
       $producto->descripcion = $request->descripcion;
       $producto->marca = $request->marca;
       $producto->precio = $request->precio;
       $producto->codigo = $request->codigo;
       $producto->peso = $request->peso;
       $producto->estado = 1;
       //Guardamos
       if ($producto->save()) {
            $productos = $this->listar();
            $respuesta =  1;
            $inventario = new Inventario;
            $inventario->stock = 0;
            $inventario->ubicacion = "no especificada";
            $inventario->producto_id = $producto->id;
            $inventario->estado = 1;
            $inventario->save();
          return redirect('producto/index')->with('respuesta', $respuesta);    
       } else {
        
        $respuesta = -1;
        return redirect('producto/index')->with('respuesta', $respuesta);  
           
       }
   }

    
    public function show($id)
    {
        $producto=DB::table('productos as p')
        ->join('categorias as c','p.categoria_id','=','c.id')
        
        ->select(  'p.id as idproducto','p.codigo','p.producto','p.descripcion','c.categoria as categoria','p.marca','p.precio','p.peso')
        ->where('p.id','=',$id)->first() ;
        
            return  $producto ;
        

    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('producto/edit',['producto'=>$producto,'categorias'=>$categorias]);
    }
    
    public function update(Request $request, $id) 
    {
        //Regla de validación
        $rules = [
            'producto' => 'required|string|max:30',
            'categoria_id' => 'required|integer',
            'descripcion' => 'required|string|max:100',
            'marca' => 'required|string|max:30',
            'precio' => 'required',
            'codigo' => 'required',
            'peso' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $producto = Producto::find($id);

        if ($producto) {
            //Cambiamos el nombre del registro con el valor enviado por Request
            $producto->producto = $request->producto;
            $producto->categoria_id = $request->categoria_id;
            $producto->descripcion = $request->descripcion;
            $producto->marca = $request->marca;
            $producto->precio = $request->precio;
            $producto->codigo = $request->codigo;
            $producto->peso = $request->peso;
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($producto->update()) { 
                $respuesta =  2;
                return redirect('producto/index')->with('respuesta', $respuesta);  
            } else { 
                $respuesta =  -2;
                return redirect('producto/index')->with('respuesta', $respuesta);  
            }
        } else { 
            $respuesta =  -5;
            return redirect('producto/index')->with('respuesta', $respuesta);  
        }
    }

    
    public function destroy($id) 
    {
        //buscamos el registro con el id enviado por la URL
        $producto = Producto::find($id);
        if ($producto) {
          
            $producto->estado = 0;
                if ($producto->update()) { 
                $respuesta =  3;
                return redirect('producto/index')->with('respuesta', $respuesta);  
                } else {
                     
                $respuesta =  -3;
                return redirect('producto/index')->with('respuesta', $respuesta);  
                }
            
        } else { 
            $respuesta =  -5;
            return redirect('producto/index')->with('respuesta', $respuesta);  
        }
    }
}
