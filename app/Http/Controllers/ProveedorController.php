<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        
        $proveedores = $this->listar();
        
        // return $consulta;
        return view("proveedor/index", ['proveedores' => $proveedores ]);
    }

    public function listar()
    {
        $proveedores = DB::table('proveedors as p')

            ->select('p.id as idproveedor', 'p.proveedor', 'p.direccion', 'p.descripcion', 'p.email', 'p.telefono')
            ->where('p.estado', '=', '1')->get();

        return $proveedores;
    }

    public function create()
    {

        return view("proveedor/create");
    }

    public function store(Request $request)
    {
        //Regla de validación
        $rules = [
            'proveedor' => 'required|string',
            'direccion' => 'required|string',
            'descripcion' => 'required|string|max:100',
            'email' => 'required|string|max:30',
            'telefono' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //Instancia modelo Gender
        $proveedor = new Proveedor;
        //Llevanos el modelo con los datos del Request
        $proveedor->proveedor = $request->proveedor;
        $proveedor->direccion = $request->direccion;
        $proveedor->descripcion = $request->descripcion;
        $proveedor->email = $request->email;
        $proveedor->telefono = $request->telefono;
        $proveedor->estado = 1;
        //Guardamos
        if ($proveedor->save()) {
          
            $respuesta =  1;
            return redirect('proveedor/index')->with('respuesta', $respuesta);
        } else {
            
            $respuesta = -1;
            return redirect('proveedor/index')->with('respuesta', $respuesta);
        }
    }


    public function show($id)
    {
        $proveedor = DB::table('proveedors as p')
            ->select('p.id as idproveedor', 'p.proveedor', 'p.direccion', 'p.descripcion', 'p.email', 'p.telefono')
            ->where('p.id', '=', $id)->first();

        return  $proveedor;
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);

        return view('proveedor/edit', ['proveedor' => $proveedor]);
    }

    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'proveedor' => 'required|string',
            'direccion' => 'required|string',
            'descripcion' => 'required|string|max:100',
            'email' => 'required|string|max:30',
            'telefono' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $proveedor = Proveedor::find($id);

        if ($proveedor) {
            //Cambiamos el nombre del registro con el valor enviado por Request
            $proveedor->proveedor = $request->proveedor;
            $proveedor->direccion = $request->direccion;
            $proveedor->descripcion = $request->descripcion;
            $proveedor->email = $request->email;
            $proveedor->telefono = $request->telefono;
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($proveedor->update()) {
                 
                $respuesta =  2;
                return redirect('proveedor/index')->with('respuesta', $respuesta);
            } else {
                
                $respuesta =  -2;
                return redirect('proveedor/index')->with('respuesta', $respuesta);
            }
        } else {
             
            $respuesta =  -5;
            return redirect('proveedor/index')->with('respuesta', $respuesta);
        }
    }


    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $proveedor = Proveedor::find($id);
        if ($proveedor) {

            $proveedor->estado = 0;
            if ($proveedor->update()) {
                
                $respuesta =  3;
                return redirect('proveedor/index')->with('respuesta', $respuesta);
            } else {
                 
                $respuesta =  -3;
                return redirect('proveedor/index')->with('respuesta', $respuesta);
            }
        } else {
             
            $respuesta =  -5;
            return redirect('proveedor/index')->with('respuesta', $respuesta);
        }
    }
}
