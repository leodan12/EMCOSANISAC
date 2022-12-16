<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
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
            'dni' =>rand(11111111,99999999),
            'email' =>$this->faker->unique()->email(),
            'telefono' => $this->faker->phoneNumber(),
            'puesto' => $this->faker->randomElement(['administrador', 'ventas', 'inventarios']),
            'estado' => 1,
            'user_id' =>2,
        ];
    }
}
