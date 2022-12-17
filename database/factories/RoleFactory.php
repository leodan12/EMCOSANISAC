<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rol' =>$this->faker->randomElement(['ADMINISTRADOR','PERSONAL', 'CLIENTE']),
            'descripcion' =>$this->faker->text(20),
            'estado' => 1,
        ];
    }
}