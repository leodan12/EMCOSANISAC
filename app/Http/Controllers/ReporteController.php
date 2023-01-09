<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fecha_actual = date("Y-m-d");
        $fecha_mes_anterior = date("Y-m-d", strtotime("-1 month"));

        $ventas = DB::table('ventas as v')
            ->select(DB::raw('sum(v.costoventa) as ingreso'), 'v.fecha as fecha')
            ->groupBy('v.fecha')
            ->whereBetween('v.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
         

        return view('reporte.ventas', ['ventas' => $ventas]);
    }
    public function index2()
    {
        $fecha_actual = date("Y-m-d");
        $fecha_mes_anterior = date("Y-m-d", strtotime("-1 month"));

        $compras = DB::table('compras as c')
            ->select(DB::raw('sum(c.costocompra) as egreso'), 'c.fecha as fecha')
            ->groupBy('c.fecha')
            ->whereBetween('c.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
         
         
        return view('reporte.compras', ['compras' => $compras]);
    }

    public function graficoProductos()
    {
        //$registros=DB::select('call productosxcategoria()');
        $registros = DB::table('productos as p')
            ->join('categorias as c', 'p.categoria_id', '=', 'c.id')
            ->select('c.categoria as categoria', DB::raw('count(p.id) as producto'))
            ->groupBy('c.categoria')
            ->where('p.estado', '=', '1')
            ->get();



        //$registrosDos=DB::select('call alumnosxperiodo()');
        //$registrosTres=DB::select('call alumnosxnivel()');
        return view('reporte.reporte1', ['registros' => $registros]);
    }

    public function nuestrasVentas($fechaI, $fechaF)
    {
        //$registros=DB::select('call productosxcategoria()');

        $ventas = DB::table('ventas as v')
            ->select(DB::raw('sum(v.costoventa) as ingresos'), 'v.fecha as fecha')
            ->groupBy('v.fecha')
            ->whereBetween('v.fecha', [$fechaI, $fechaF])
            ->get();

        return  ['ventas' => $ventas];
    }

    public function nuestrasCompras($fechaI, $fechaF)
    {
        

        $compras = DB::table('compras as c')
            ->select(DB::raw('sum(c.costocompra) as egresos'), 'c.fecha as fecha')
            ->groupBy('c.fecha')
            ->whereBetween('c.fecha', [$fechaI, $fechaF])
            ->get();

        return  ['compras' => $compras];
    }

    public function ingresos()
    {
        //fechas
        $fecha_actual = date("Y-m-d");
        $fecha_semana_anterior = date("Y-m-d", strtotime("-1 week"));
        $fecha_mes_anterior = date("Y-m-d", strtotime("-1 month"));

        //ingresos de ventas
        $ingresodia = DB::table('ventas as v')
            ->select(DB::raw('sum(v.costoventa) as ingresodia'))
            ->where('v.fecha', '=', $fecha_actual)
            ->get();
        $ingresosemana = DB::table('ventas as v')
            ->select(DB::raw('sum(v.costoventa) as ingresosemana'))
            ->whereBetween('v.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $ingresomes = DB::table('ventas as v')
            ->select(DB::raw('sum(v.costoventa) as ingresomes'))
            ->whereBetween('v.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
        //numero de productos vendidos
        $productosdia = DB::table('ventas as v')
            ->join('detalleventas as dv', 'dv.venta_id', '=', 'v.id')
            ->select(DB::raw('sum(dv.cantidad) as productosdia'))
            ->where('v.fecha', '=', $fecha_actual)
            ->get();
        $productossemana = DB::table('ventas as v')
            ->join('detalleventas as dv', 'dv.venta_id', '=', 'v.id')
            ->select(DB::raw('sum(dv.cantidad) as productossemana'))
            ->whereBetween('v.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $productosmes = DB::table('ventas as v')
            ->join('detalleventas as dv', 'dv.venta_id', '=', 'v.id')
            ->select(DB::raw('sum(dv.cantidad) as productosmes'))
            ->whereBetween('v.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
        //numero de ventas hechas
        $ventasdia = DB::table('ventas as v')
            ->select(DB::raw('count(v.id) as ventasdia'))
            ->where('v.fecha', '=', $fecha_actual)
            ->get();
        $ventassemana = DB::table('ventas as v')
            ->select(DB::raw('count(v.id) as ventassemana'))
            ->whereBetween('v.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $ventasmes = DB::table('ventas as v')
            ->select(DB::raw('count(v.id) as ventasmes'))
            ->whereBetween('v.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();

        //return $ventasmes;

        return  [
            'ingresodia' => $ingresodia, 'ingresosemana' => $ingresosemana, 'ingresomes' => $ingresomes,
            'productosdia' => $productosdia, 'productossemana' => $productossemana, 'productosmes' => $productosmes,
            'ventasdia' => $ventasdia, 'ventassemana' => $ventassemana, 'ventasmes' => $ventasmes
        ];
    }

    public function egresos()
    {
        //fechas
        $fecha_actual = date("Y-m-d");
        $fecha_semana_anterior = date("Y-m-d", strtotime("-1 week"));
        $fecha_mes_anterior = date("Y-m-d", strtotime("-1 month"));

        //ingresos de ventas
        $egresodia = DB::table('compras as c')
            ->select(DB::raw('sum(c.costocompra) as egresodia'))
            ->where('c.fecha', '=', $fecha_actual)
            ->get();
        $egresosemana = DB::table('compras as c')
            ->select(DB::raw('sum(c.costocompra) as egresosemana'))
            ->whereBetween('c.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $egresomes = DB::table('compras as c')
            ->select(DB::raw('sum(c.costocompra) as egresomes'))
            ->whereBetween('c.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
        //numero de productos vendidos
        $productosdia = DB::table('compras as c')
            ->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')
            ->select(DB::raw('sum(dc.cantidad) as productosdia'))
            ->where('c.fecha', '=', $fecha_actual)
            ->get();
        $productossemana = DB::table('compras as c')
            ->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')
            ->select(DB::raw('sum(dc.cantidad) as productossemana'))
            ->whereBetween('c.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $productosmes = DB::table('compras as c')
            ->join('detalecompras as dc', 'dc.compra_id', '=', 'c.id')
            ->select(DB::raw('sum(dc.cantidad) as productosmes'))
            ->whereBetween('c.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();
        //numero de ventas hechas
        $comprasdia = DB::table('compras as c')
            ->select(DB::raw('count(c.id) as comprasdia'))
            ->where('c.fecha', '=', $fecha_actual)
            ->get();
        $comprassemana = DB::table('compras as c')
            ->select(DB::raw('count(c.id) as comprassemana'))
            ->whereBetween('c.fecha', [$fecha_semana_anterior, $fecha_actual])
            ->get();
        $comprasmes = DB::table('compras as c')
            ->select(DB::raw('count(c.id) as comprasmes'))
            ->whereBetween('c.fecha', [$fecha_mes_anterior, $fecha_actual])
            ->get();

         //return $comprasmes;

        return  [
            'egresodia' => $egresodia, 'egresosemana' => $egresosemana, 'egresomes' => $egresomes,
            'productosdia' => $productosdia, 'productossemana' => $productossemana, 'productosmes' => $productosmes,
            'comprasdia' => $comprasdia, 'comprassemana' => $comprassemana, 'comprasmes' => $comprasmes
        ];
}
}