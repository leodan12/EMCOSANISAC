<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(PersonalSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(InventarioSeeder::class);
        $this->call(CompraSeeder::class);
        $this->call(CompradetalleSeeder::class);
        $this->call(VentaSeeder::class);
        $this->call(DetalleventaSeeder::class);
       // \App\Models\Role::factory(2)->create();
        //\App\Models\User::factory(1)->create();
        //\App\Models\Proveedor::factory(20)->create();
        //\App\Models\Categoria::factory(20)->create();
        //\App\Models\Producto::factory(100)->create();
        //\App\Models\Personal::factory(1)->create();
        //\App\Models\Inventario::factory(100)->create();
        //\App\Models\Compra::factory(50)->create();
        //\App\Models\Detalecompra::factory(200)->create();
        //\App\Models\Cliente::factory(1)->create();
        //\App\Models\Venta::factory(50)->create();
        //\App\Models\Detalleventa::factory(200)->create();
        
    }
}
