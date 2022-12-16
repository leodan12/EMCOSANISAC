<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $clientes = $this->listar();

        // return $consulta;
        return view("cliente/index", ['clientes' => $clientes]);
    }

    public function listar()
    {
        $clientes = DB::table('clientes as c')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->select('c.id as idcliente', 'c.nombres', 'c.apellidos', 'c.direccion', 'c.tipodocumento','c.numerodocumento', 'c.email', 'c.telefono', 'u.id as iduser')
            ->where('c.estado', '=', '1')->get();

        return $clientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cliente/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Regla de validación
        $rules = [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required',
            'tipodocumento' => 'required',
            'numerodocumento' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }

        $users = User::all();
        foreach ($users as $user) {
            if ($user->email == $request->email) {
                $respuesta = 'email_duplicado';
                return redirect("cliente/create")->with('respuesta', $respuesta);
            } else {

                $user = new User;
                $user->name = $request->nombres. " " .$request->apellidos;
                $user->password = Hash::make($request->dni);
                $user->rol_id= 4;
                $user->email = $request->email;
                $user->estado= 1;
                $user->save();
                //Instancia modelo 
                $cliente = new Cliente;
                //Llevanos el modelo con los datos del Request
                $cliente->nombres = $request->nombres;
                $cliente->apellidos = $request->apellidos;
                $cliente->direccion = $request->direccion;
                $cliente->tipodocumento = $request->tipodocumento;
                $cliente->email = $request->email;
                $cliente->telefono = $request->telefono;
                $cliente->numerodocumento = $request->numerodocumento;
                $cliente->estado = 1;
                $cliente->user_id = $user->id;
                //Guardamos
                if ($cliente->save()) {

                    $respuesta =  1;
                    return redirect('cliente/index')->with('respuesta', $respuesta);
                } else {

                    $respuesta = -1;
                    return redirect('cliente/index')->with('respuesta', $respuesta);
                }
            }
        }
    }

    
    public function show($id)
    {
        $cliente = DB::table('clientes as p')
            ->join('users as u','p.user_id','=','u.id')
            ->select('p.id as idcliente', 'p.nombres', 'p.apellidos', 'p.direccion', 'p.email', 'p.telefono', 'p.numerodocumento', 'p.tipodocumento','u.id as iduser')
            ->where('p.id', '=', $id)->first();

        return  $cliente;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente/edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|string',
            'telefono' => 'required',
            'tipodocumento' => 'required',
            'numerodocumento' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //Instancia modelo 
        $cliente = Cliente::find($id);
        //Llevanos el modelo con los datos del Request
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->direccion = $request->direccion;
        $cliente->tipodocumento = $request->tipodocumento;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->numerodocumento = $request->numerodocumento;
        $cliente->estado = 1;
        //Guardamos
        if ($cliente->update()) {

            $respuesta =  2;
            return redirect('cliente/index')->with('respuesta', $respuesta);
        } else {

            $respuesta = -2;
            return redirect('cliente/index')->with('respuesta', $respuesta);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $cliente = Cliente::find($id);
        if ($cliente) {

            $cliente->estado = 0;
            if ($cliente->update()) {

                $respuesta =  3;
                return redirect('cliente/index')->with('respuesta', $respuesta);
            } else {

                $respuesta =  -3;
                return redirect('cliente/index')->with('respuesta', $respuesta);
            }
        } else {

            $respuesta =  -5;
            return redirect('cliente/index')->with('respuesta', $respuesta);
        }
    }
}
