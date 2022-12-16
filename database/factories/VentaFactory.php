<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
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
            'costoventa' => rand(1000,20000),
            'estadoventa' => $this->faker->randomElement(['PEDIDO', 'PAGADO', 'ENTREGADO']),
            'estado' => rand(0,1),
            'cliente_id' => 1,
            'usuario_id' => 2,
        ];
    }
}
