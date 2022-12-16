<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detalecompra>
 */
class DetalecompraFactory extends Factory
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
            'unidadmedida' =>$this->faker->mimeType,
            'preciounidad' => rand(100,500),
            'preciototal' => rand(1000,1000),
            'estado' => 1,
            'inventario_id' => rand(1,100),
            'compra_id' => rand(1,50),
        ];
    }
}
