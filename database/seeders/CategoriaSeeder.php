<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        DB::table('categorias')->insert([
            'categoria' => 'computadoras',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'celulares',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'laptops',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'impresoras',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'proyectores',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'cpu',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'monitores',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'teclados',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'mouses',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
          DB::table('categorias')->insert([
            'categoria' => 'repuestos',
            'descripcion' => 'sin descripcion',
            'estado' => 1,
          ]);
    }
}
