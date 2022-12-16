<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonalController extends Controller
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
        $personales = $this->listar();

        // return $consulta;
        return view("personal/index", ['personales' => $personales]);
    }

    public function listar()
    {
        $personales = DB::table('personals as p')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->select('p.id as idpersonal', 'p.nombres', 'p.apellidos', 'p.dni', 'p.email', 'p.telefono', 'p.puesto', 'u.id as iduser')
            ->where('p.estado', '=', '1')->get();

        return $personales;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("personal/create");
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
            'dni' => 'required|string|max:100',
            'email' => 'required|string|max:30',
            'telefono' => 'required',
            'puesto' => 'required'
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
                return redirect("personal/create")->with('respuesta', $respuesta);
            } else {

                $user = new User;
                $user->name = $request->nombres . " " . $request->apellidos;
                $user->password = Hash::make($request->dni);
                $user->rol_id = 2;
                $user->email = $request->email;
                $user->estado = 1;
                $user->save();
                //Instancia modelo 
                $personal = new Personal;
                //Llevanos el modelo con los datos del Request
                $personal->nombres = $request->nombres;
                $personal->apellidos = $request->apellidos;
                $personal->dni = $request->dni;
                $personal->email = $request->email;
                $personal->telefono = $request->telefono;
                $personal->puesto = $request->puesto;
                $personal->estado = 1;
                $personal->user_id = $user->id;
                //Guardamos
                if ($personal->save()) {

                    $respuesta =  1;
                    return redirect('personal/index')->with('respuesta', $respuesta);
                } else {

                    $respuesta = -1;
                    return redirect('personal/index')->with('respuesta', $respuesta);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personal = DB::table('personals as p')
            ->join('users as u', 'p.user_id', '=', 'u.id')
            ->select('u.id as iduser','p.id as idpersonal', 'p.nombres', 'p.apellidos', 'p.dni', 'p.email', 'p.telefono', 'p.puesto')
            ->where('p.id', '=', $id)->first();

        return  $personal;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = Personal::find($id);

        return view('personal/edit', ['personal' => $personal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'dni' => 'required|string|max:100',
            'email' => 'required|string|max:30',
            'telefono' => 'required',
            'puesto' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //Instancia modelo 
        $personal = Personal::find($id);
        //Llevanos el modelo con los datos del Request
        $personal->nombres = $request->nombres;
        $personal->apellidos = $request->apellidos;
        $personal->dni = $request->dni;
        $personal->email = $request->email;
        $personal->telefono = $request->telefono;
        $personal->puesto = $request->puesto;
        $personal->estado = 1;
        //Guardamos
        if ($personal->update()) {

            $respuesta =  2;
            return redirect('personal/index')->with('respuesta', $respuesta);
        } else {

            $respuesta = -2;
            return redirect('personal/index')->with('respuesta', $respuesta);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $personal = Personal::find($id);
        if ($personal) {

            $personal->estado = 0;
            if ($personal->update()) {

                $respuesta =  3;
                return redirect('personal/index')->with('respuesta', $respuesta);
            } else {

                $respuesta =  -3;
                return redirect('personal/index')->with('respuesta', $respuesta);
            }
        } else {

            $respuesta =  -5;
            return redirect('personal/index')->with('respuesta', $respuesta);
        }
    }
}
