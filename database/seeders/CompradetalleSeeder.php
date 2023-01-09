<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompradetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('detalecompras')->insert([
            'cantidad' => 5,
            'unidadmedida' => 'unidades',
            'preciounidad' => 100,
            'preciototal' => 500,
            'inventario_id' => 1, 
            'compra_id' => 1, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 50,
            'unidadmedida' => 'unidades',
            'preciounidad' => 100,
            'preciototal' => 5000,
            'inventario_id' => 2, 
            'compra_id' => 1, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 10,
            'unidadmedida' => 'unidades',
            'preciounidad' => 20,
            'preciototal' => 200,
            'inventario_id' => 3, 
            'compra_id' => 2, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 10,
            'unidadmedida' => 'unidades',
            'preciounidad' => 10,
            'preciototal' => 100,
            'inventario_id' => 4, 
            'compra_id' => 3, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 20,
            'unidadmedida' => 'unidades',
            'preciounidad' => 20,
            'preciototal' => 400,
            'inventario_id' => 3, 
            'compra_id' => 3, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 10,
            'unidadmedida' => 'unidades',
            'preciounidad' => 15,
            'preciototal' => 150,
            'inventario_id' => 1, 
            'compra_id' => 4, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 5,
            'unidadmedida' => 'unidades',
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'compra_id' => 6, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 4,
            'unidadmedida' => 'unidades',
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'compra_id' => 8, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 3,
            'unidadmedida' => 'unidades',
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'compra_id' => 7, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 4,
            'unidadmedida' => 'unidades',
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'compra_id' => 6, 
            'estado' => 1,
          ]);
          DB::table('detalecompras')->insert([
            'cantidad' => 5,
            'unidadmedida' => 'unidades',
            'preciounidad' => 5,
            'preciototal' => 25,
            'inventario_id' => 2, 
            'compra_id' => 5, 
            'estado' => 1,
          ]);
    }
}