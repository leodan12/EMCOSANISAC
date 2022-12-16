<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function index() 
    { 
     $categorias = $this->listar();
     // return $consulta;
      return view("categoria/index",['categorias'=>$categorias]) ;
    
   }
  
   public function listar()
   {
    $categorias=DB::table('categorias as c')
         ->select('c.id as idcategoria','c.categoria as categoria','c.descripcion as descripcion')
         ->where('c.estado','=','1')->get() ;
      
    return $categorias;
   }
   
   public function create(){
     return view("categoria/create");
   }
  
   public function store(Request $request)
   { 
     //Regla de validación
       $rules = [
            
            'categoria' => 'required|string',
            'descripcion' => 'required|string|max:100'
            
          
       ];
       //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
       $validator = Validator::make($request->all(), $rules);
       //Si falla la validacion retornamos los errores
       if ($validator->fails()) {
           return $validator->errors();
       }
       //Instancia modelo Gender
       $categoria = new Categoria;
       //Llevanos el modelo con los datos del Request
       $categoria->categoria = $request->categoria;
       $categoria->descripcion = $request->descripcion;
       $categoria->estado = 1;
       //Guardamos
       if ($categoria->save()) {
        
            $respuesta =  1;
            return redirect('categoria/index')->with('respuesta', $respuesta);    
       } else {
        
        $respuesta = -1;
        return redirect('categoria/index')->with('respuesta', $respuesta);    
           
       }
   }

    
    public function show($id)
    {
        $categoria=DB::table('categorias as c')
        
        ->select('c.categoria','c.descripcion')
        ->where('c.id','=',$id)->first() ;
        
            return  $categoria ;
        

    }

    public function edit($id){
        $categoria = Categoria::find($id); 
        return view('categoria/edit',['categoria'=>$categoria]);
    }
    
    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'categoria' => 'required|string',
            'descripcion' => 'required|string|max:100'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $categoria = Categoria::find($id);

        if ($categoria) {
            //Cambiamos el nombre del registro con el valor enviado por Request
             
            $categoria->categoria = $request->categoria;
            $categoria->descripcion = $request->descripcion;
            
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($categoria->update()) {
                
                $respuesta =  2;
                return redirect('categoria/index')->with('respuesta', $respuesta);    
            } else {
                
                $respuesta =  -2;
                return redirect('categoria/index')->with('respuesta', $respuesta);    
            }
        } else {
            
            $respuesta =  -5;
            return redirect('categoria/index')->with('respuesta', $respuesta);    
        }
    }

    
    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $categoria = Categoria::find($id);
        if ($categoria) {
          
            $categoria->estado = 0;
                if ($categoria->update()) {
                   
                $respuesta =  3;
                return redirect('categoria/index')->with('respuesta', $respuesta);    
                } else {
                  
                $respuesta =  -3;
                return redirect('categoria/index')->with('respuesta', $respuesta);    
                }
            
        } else {
            
            $respuesta =  -5;
            return redirect('categoria/index')->with('respuesta', $respuesta);    
        }
    }
}
