<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha' =>$this->faker->date(),
            'descripcion' =>$this->faker->text(40),
            'costocompra' => rand(1000,20000),
            'estadocompra' => $this->faker->randomElement(['PEDIDO', 'PAGADO', 'RECIBIDO']),
            'estado' => rand(0,1),
            'proveedor_id' => rand(1,20),
            'usuario_id' => 1,
        ];
    }
}
