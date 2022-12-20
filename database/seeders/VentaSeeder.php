<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('ventas')->insert([
            'fecha' => '2022-10-12',
            'descripcion' => 'sin descripcion',
            'costoventa' => 5000,
            'estadoventa' => 'ENTREGADO',
            'cliente_id' => 1, 
            'usuario_id' => '5', 
            'estado' => 1,
          ]);
          DB::table('ventas')->insert([
            'fecha' => '2022-11-12',
            'descripcion' => 'sin descripcion',
            'costoventa' => 500,
            'estadoventa' => 'PEDIDO',
            'cliente_id' => 2, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('ventas')->insert([
            'fecha' => '2022-10-09',
            'descripcion' => 'sin descripcion',
            'costoventa' => 800,
            'estadoventa' => 'ENTREGADO',
            'cliente_id' => 1, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('ventas')->insert([
            'fecha' => '2022-06-08',
            'descripcion' => 'sin descripcion',
            'costoventa' => 1000,
            'estadoventa' => 'PAGADO',
            'cliente_id' => 2, 
            'usuario_id' => '4', 
            'estado' => 1,
          ]);
          DB::table('ventas')->insert([
            'fecha' => '2022-10-10',
            'descripcion' => 'sin descripcion',
            'costoventa' => 1500,
            'estadoventa' => 'PEDIDO',
            'cliente_id' => 1, 
            'usuario_id' => '5', 
            'estado' => 1,
          ]);

    }
}