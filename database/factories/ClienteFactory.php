<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombres' =>$this->faker->firstName(),
            'apellidos' =>$this->faker->lastName(),
            'direccion' =>$this->faker->address(),
            'email' =>$this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'tipodocumento' => $this->faker->randomElement(['DNI', 'RUC']),
            'numerodocumento' => rand(11111111,9999999999),
            'estado' => 1,
            'user_id' =>4,
        ];
    }
}
