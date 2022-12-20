<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('personals')->insert([
            'nombres' => 'leodan',
            'apellidos' => 'machuca iparraguirre',
            'dni' => '87654321',
            'puesto' => 'ADMINISTRADOR',
            'email' => 'mleodan9@gmail.com',
            'telefono' => '986532741', 
            'user_id' => 1, 
            'estado' => 1,
          ]);
          DB::table('personals')->insert([
            'nombres' => 'leandro',
            'apellidos' => 'villarroel rodriguez',
            'dni' => '12345678',
            'puesto' => 'PERSONAL DE VENTAS',
            'email' => 'lvillarroel@gmail.com',
            'telefono' => '986532741', 
            'user_id' => 2, 
            'estado' => 1,
          ]);
          DB::table('personals')->insert([
            'nombres' => 'juan',
            'apellidos' => 'alvarez perez',
            'dni' => '87654321',
            'puesto' => 'PERSONAL DE INVENTARIO',
            'email' => 'juan@gmail.com',
            'telefono' => '986532741', 
            'user_id' => 3, 
            'estado' => 1,
          ]);

    }}