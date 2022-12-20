<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('inventarios')->insert([
            'stock' => 10,
            'ubicacion' => 'repisa nro 5 level 10',
            'producto_id' => 1,
            'estado' => 1,
          ]);
          DB::table('inventarios')->insert([
            'stock' => 20,
            'ubicacion' => 'repisa nro 2 level 5',
            'producto_id' => 1,
            'estado' => 1,
          ]);
          DB::table('inventarios')->insert([
            'stock' => 30,
            'ubicacion' => 'repisa nro 3 level 7',
            'producto_id' => 1,
            'estado' => 1,
          ]);
          DB::table('inventarios')->insert([
            'stock' => 15,
            'ubicacion' => 'repisa nro 8 level 3',
            'producto_id' => 1,
            'estado' => 1,
          ]);
          
          
    }
}