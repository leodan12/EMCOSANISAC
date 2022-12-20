<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('productos')->insert([
            'producto' => 'mouse gamer',
            'categoria_id' => 9,
            'marca' => 'logitech',
            'codigo' => 'MG-L300', 
            'precio' => 50, 
            'peso' => 200, 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('productos')->insert([
            'producto' => 'computadora de escritorio',
            'categoria_id' => 1,
            'marca' => 'HP',
            'codigo' => 'ALL-IN-ONE', 
            'precio' => 5000, 
            'peso' => 600, 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('productos')->insert([
            'producto' => 'Impresora mmultifuncional',
            'categoria_id' => 4,
            'marca' => 'Brothers',
            'codigo' => 'IM-B', 
            'precio' => 3000, 
            'peso' => 2500, 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('productos')->insert([
            'producto' => 'proyector multimedia',
            'categoria_id' => 5,
            'marca' => 'epson',
            'codigo' => 'PM-E', 
            'precio' => 3000, 
            'peso' => 500, 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('productos')->insert([
            'producto' => 'monitor 24 pulgadas',
            'categoria_id' => 4,
            'marca' => 'HP',
            'codigo' => 'M-HP', 
            'precio' => 600, 
            'peso' => 500, 
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          
          
    }
}