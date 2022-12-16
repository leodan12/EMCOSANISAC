<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'stock' =>rand(0,100),
            'ubicacion' =>$this->faker->lastName(),
            'producto_id' => rand(1,100) ,   
            'estado' => rand(0,1),
        ];
    }
}
