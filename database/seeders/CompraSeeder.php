<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('compras')->insert([
            'fecha' => '2022-11-12',
            'descripcion' => 'sin descripcion',
            'costocompra' => 500,
            'estadocompra' => 'PEDIDO',
            'proveedor_id' => 1, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('compras')->insert([
            'fecha' => '2022-10-09',
            'descripcion' => 'sin descripcion',
            'costocompra' => 800,
            'estadocompra' => 'RECIBIDO',
            'proveedor_id' => 3, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('compras')->insert([
            'fecha' => '2022-06-08',
            'descripcion' => 'sin descripcion',
            'costocompra' => 1000,
            'estadocompra' => 'PAGADO',
            'proveedor_id' => 4, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('compras')->insert([
            'fecha' => '2022-10-10',
            'descripcion' => 'sin descripcion',
            'costocompra' => 1500,
            'estadocompra' => 'PEDIDO',
            'proveedor_id' => 1, 
            'usuario_id' => '5', 
            'estado' => 1,
          ]);
          DB::table('compras')->insert([
            'fecha' => '2022-10-12',
            'descripcion' => 'sin descripcion',
            'costocompra' => 5000,
            'estadocompra' => 'RECIBIDO',
            'proveedor_id' => 1, 
            'usuario_id' => '5', 
            'estado' => 1,
          ]);
    }
}