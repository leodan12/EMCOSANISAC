<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categoria_id' => rand(1,6),
            'producto' =>$this->faker->name,
            'codigo' =>$this->faker->countryCode(),
            'descripcion' =>$this->faker->text(40),
            'marca' =>$this->faker->firstName(),
            'precio' => rand(1,100),
            'peso' => rand(1,1000),
            'estado' => rand(0,1),
        ];
    }
}
