<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Proveedor;
use App\Models\Inventario;
use App\Models\Detalecompra;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$compras = compra::all();
        $compras = $this->listar();

        // return $compras;
        return view("compra/index", ['compras' => $compras]);
    }

    public function listar()
    {
        $compras = DB::table('compras as c')
            ->join('proveedors as pro', 'c.proveedor_id', '=', 'pro.id')
            ->join('users as u', 'c.usuario_id', '=', 'u.id')
            ->select('c.id as idcompra', 'c.fecha', 'c.descripcion', 'c.costocompra', 'c.estadocompra', 'pro.proveedor', 'u.name as usuario')
            ->where('c.estado', '=', '1')->get();

        return $compras;
    }

    public function create()
    {
        $productos = DB::table('productos as p')->join('inventarios as i', 'i.producto_id', '=', 'p.id')

            ->select('i.id as idinventario', 'p.producto')
            ->where('p.estado', '=', '1')
            ->where('i.estado', '=', '1')->get();

        $proveedores = Proveedor::all();
        return view("compra/create", ['proveedores' => $proveedores, 'productos' => $productos]);
    }

    public function store(Request $request)
    {
        //Regla de validación
        $rules = [
            'fecha' => 'required|string|max:30',
            'proveedor' => 'required',
            'descripcion' => 'required|string|max:100',
            'costoCompra' => 'required',
            'estadoCompra' => 'required'

        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //Instancia modelo Gender
        $compra = new Compra;
        //Llevanos el modelo con los datos del Request
        $compra->fecha = $request->fecha;
        $compra->proveedor_id = $request->proveedor;
        $compra->descripcion = $request->descripcion;
        $compra->costocompra = $request->costoCompra;
        $compra->estadocompra = $request->estadoCompra;
        $compra->usuario_id = Auth::id();
        $compra->estado = 1;
        //Guardamos
        if ($compra->save()) {

            $respuesta =  1;
            $cantidad = $request->Lcantidad;
            $unidadmedida = $request->Lunidadmedida;
            $preciounidad = $request->Lpreciounidad;
            $preciototal = $request->Lpreciototal;
            $inventario = $request->Linventario;

            if ($inventario !== null) {
                for ($i = 0; $i < count($inventario); $i++) {

                    $Detallecompra = new Detalecompra;
                    $Detallecompra->cantidad = $cantidad[$i];
                    $Detallecompra->unidadmedida = $unidadmedida[$i];
                    $Detallecompra->preciounidad = $preciounidad[$i];
                    $Detallecompra->preciototal = $preciototal[$i];
                    $Detallecompra->compra_id = $compra->id;
                    $Detallecompra->inventario_id = $inventario[$i];
                    $Detallecompra->estado = 1;
                    $Detallecompra->save();
                    if ($compra->estadocompra == 'RECIBIDO') {
                        $stockProdcuto = Inventario::find($inventario[$i]);
                        $stockProdcuto->stock = $stockProdcuto->stock + $cantidad[$i];
                        $stockProdcuto->update();
                    }
                }
            }

            return redirect('compra/index')->with('respuesta', $respuesta);
        } else {

            $respuesta = -1;
            return redirect('compra/index')->with('respuesta', $respuesta);
        }
    }


    public function show($id)
    {

        $compra = DB::table('compras as c')
            ->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')
            ->join('inventarios as i', 'dc.inventario_id', '=', 'i.id')
            ->join('productos as pi', 'i.producto_id', '=', 'pi.id')
            ->join('proveedors as pro', 'c.proveedor_id', '=', 'pro.id')
            ->join('users as u', 'c.usuario_id', '=', 'u.id')
            ->select(
                'c.id as idcompra',
                'c.fecha',
                'c.costocompra',
                'c.descripcion',
                'c.estadocompra',
                'pro.proveedor as proveedor',
                'u.name as usuario',
                'u.id as idusuario',
                'dc.cantidad',
                'dc.preciounidad',
                'dc.preciototal',
                'dc.unidadmedida',
                'pi.producto'
            )
            ->where('c.estado', '=', '1')
            ->where('dc.estado', '=', '1')
            ->where('c.id', '=', $id)->get();

        return  $compra;
    }

    public function edit($id)
    {
        $compra = Compra::find($id);
        $productos = DB::table('productos as p')->join('inventarios as i', 'i.producto_id', '=', 'p.id')

            ->select('i.id as idinventario', 'p.producto')
            ->where('p.estado', '=', '1')
            ->where('i.estado', '=', '1')->get();
        $detallescompra = DB::table('compras as c')->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')

            ->select('c.id as idcompra', 'dc.id as iddetallecompra', 'dc.inventario_id', 'dc.unidadmedida', 'dc.cantidad', 'dc.preciounidad', 'dc.preciototal')
            ->where('c.estado', '=', '1')
            ->where('dc.compra_id', '=', $id)
            ->where('dc.estado', '=', '1')->get();
        $proveedores = Proveedor::all();
        return view('compra/edit', ['compra' => $compra, 'proveedores' => $proveedores, 'productos' => $productos, 'detallescompra' => $detallescompra]);
    }

    public function update(Request $request, $id)
    {
        //Regla de validación
        $rules = [
            'fecha' => 'required|string|max:30',
            'proveedor_id' => 'required',
            'descripcion' => 'required|string|max:100',
            'costocompra' => 'required',
            'estadocompra' => 'required'
        ];
        //Usamos el Facade Validator para validar nuestra regla respecto a los datos recibidos en Request
        $validator = Validator::make($request->all(), $rules);
        //Si falla la validacion retornamos los errores
        if ($validator->fails()) {
            return $validator->errors();
        }
        //buscamos el género con el id enviado por la URL
        $compra = Compra::find($id);

        if ($compra) {
            $estadocompra=$compra->estadocompra;
            //Cambiamos el nombre del registro con el valor enviado por Request
            $compra->fecha = $request->fecha;
            $compra->proveedor_id = $request->proveedor_id;
            $compra->descripcion = $request->descripcion;
            $compra->costocompra = $request->costocompra;
            $compra->estadocompra = $request->estadocompra;
            $compra->usuario_id = 1;
            $compra->estado = 1;
            //Actualizamos y retornamos el registro con el nuevo valor
            if ($compra->update()) {

                $respuesta =  2;
                $cantidad = $request->Lcantidad;
                $unidadmedida = $request->Lunidadmedida;
                $preciounidad = $request->Lpreciounidad;
                $preciototal = $request->Lpreciototal;
                $inventario = $request->Linventario;

                if ($inventario !== null) {
                    for ($i = 0; $i < count($inventario); $i++) {

                        $Detallecompra = new Detalecompra;
                        $Detallecompra->cantidad = $cantidad[$i];
                        $Detallecompra->unidadmedida = $unidadmedida[$i];
                        $Detallecompra->preciounidad = $preciounidad[$i];
                        $Detallecompra->preciototal = $preciototal[$i];
                        $Detallecompra->compra_id = $compra->id;
                        $Detallecompra->inventario_id = $inventario[$i];
                        $Detallecompra->estado = 1;
                        $Detallecompra->save();

                    }
                }
                
                if (($estadocompra == 'PEDIDO' || $estadocompra == 'PAGADO') && $request->estadocompra == 'RECIBIDO') {

                    $DC = DB::table('compras as c')
                        ->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')
                        ->join('inventarios as i', 'dc.inventario_id', '=', 'i.id')
                        ->select(
                            'dc.cantidad',
                            'i.id',
                            'i.stock',
                        )
                        ->where('c.estado', '=', '1')
                        ->where('dc.estado', '=', '1')
                        ->where('c.id', '=', $compra->id)->get();
                    
                        for($i = 0; $i < count($DC); $i++){
                            $stockProdcuto = Inventario::find($DC[$i]->id);
                            $stockProdcuto->stock = $stockProdcuto->stock + $DC[$i]->cantidad;
                            $stockProdcuto->update();
                        }

                        
                }
                return redirect('compra/index')->with('respuesta', $respuesta);
            } else {

                $respuesta =  -2;
                return redirect('compra/index')->with('respuesta', $respuesta);
            }
        } else {

            $respuesta =  -5;
            return redirect('compra/index')->with('respuesta', $respuesta);
        }
    }


    public function destroy($id)
    {
        //buscamos el registro con el id enviado por la URL
        $compra = Compra::find($id);
        if ($compra) {

            $compra->estado = 0;
            if ($compra->update()) {

                $respuesta =  3;
                return redirect('compra/index')->with('respuesta', $respuesta);
            } else {

                $respuesta =  -3;
                return redirect('compra/index')->with('respuesta', $respuesta);
            }
        } else {

            $respuesta =  -5;
            return redirect('compra/index')->with('respuesta', $respuesta);
        }
    }

    public function destroydetallecompra($id)
    {
        //buscamos el registro con el id enviado por la URL
        $detallecompra = Detalecompra::find($id);
        if ($detallecompra) {

            $detallecompra->estado = 0;
            $detallecompra->update();

        }
    }
}
