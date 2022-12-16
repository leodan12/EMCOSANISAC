<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proveedor>
 */
class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'proveedor' =>$this->faker->company(),
            'direccion' =>$this->faker->address(),
            'descripcion' =>$this->faker->text(40),
            'email' =>$this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'estado' => rand(0,1),
        ];
    }
}
