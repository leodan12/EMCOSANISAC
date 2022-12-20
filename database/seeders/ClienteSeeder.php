<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('clientes')->insert([
            'nombres' => 'carlos',
            'apellidos' => 'diaz vera',
            'direccion' => 'av los laureles nro 404',
            'email' => 'carlosdiaz@gmail.com',
            'telefono' => '986532741', 
            'tipodocumento' => 'DNI', 
            'numerodocumento' => '45678231', 
            'user_id' => 4, 
            'estado' => 1,
          ]);
          DB::table('clientes')->insert([
            'nombres' => 'luis',
            'apellidos' => 'mendoza perez',
            'direccion' => 'av los girasoles nro 404',
            'email' => 'luisperez@gmail.com',
            'telefono' => '956782139', 
            'tipodocumento' => 'DNI', 
            'numerodocumento' => '45678231', 
            'user_id' => 4, 
            'estado' => 1,
          ]);
    }
}