<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalleventa>
 */
class DetalleventaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cantidad' => rand(1,10),
            'descuento' =>0,
            'preciounidad' => rand(100,500),
            'preciototal' => rand(1000,10000),
            'estado' => 1,
            'inventario_id' => rand(1,100),
            'venta_id' => rand(1,50),
        ];
    }
}
