<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleventaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('detalleventas')->insert([
            'cantidad' => 5,
            'descuento' => 0,
            'preciounidad' => 100,
            'preciototal' => 500,
            'inventario_id' => 1, 
            'venta_id' => 1, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 50,
            'descuento' => 0,
            'preciounidad' => 100,
            'preciototal' => 5000,
            'inventario_id' => 2, 
            'venta_id' => 1, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 10,
            'descuento' => 0,
            'preciounidad' => 20,
            'preciototal' => 200,
            'inventario_id' => 3, 
            'venta_id' => 2, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 10,
            'descuento' => 0,
            'preciounidad' => 10,
            'preciototal' => 100,
            'inventario_id' => 4, 
            'venta_id' => 3, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 20,
            'descuento' => 0,
            'preciounidad' => 20,
            'preciototal' => 400,
            'inventario_id' => 3, 
            'venta_id' => 3, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 10,
            'descuento' => 0,
            'preciounidad' => 15,
            'preciototal' => 150,
            'inventario_id' => 1, 
            'venta_id' => 4, 
            'estado' => 1,
          ]);
          DB::table('detalleventas')->insert([
            'cantidad' => 5,
            'descuento' => 0,
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'venta_id' => 4, 
            'estado' => 1,
          ]);
    }
}