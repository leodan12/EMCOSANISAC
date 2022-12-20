<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        DB::table('proveedors')->insert([
            'proveedor' => 'Samsung electronics',
            'direccion' => 'av Samsung electronics s/n nro',
            'email' => 'Samsung_electronics@gmail.com',
            'telefono' => '986532741', 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('proveedors')->insert([
            'proveedor' => 'microsoft',
            'direccion' => 'av microsoft s/n nro',
            'email' => 'microsoft@gmail.com',
            'telefono' => '123456789', 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('proveedors')->insert([
            'proveedor' => 'america movil',
            'direccion' => 'av america movil s/n nro',
            'email' => 'america movil@gmail.com',
            'telefono' => '456789321', 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('proveedors')->insert([
            'proveedor' => 'general electric',
            'direccion' => 'av general electric s/n nro',
            'email' => 'general_electric@gmail.com',
            'telefono' => '123789654', 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('proveedors')->insert([
            'proveedor' => 'china mobile',
            'direccion' => 'av china mobile s/n nro',
            'email' => 'china_mobile@gmail.com',
            'telefono' => '986532741', 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);

     }
    }