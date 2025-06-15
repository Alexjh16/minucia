<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pieza>
 */
class PiezaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numerify('PZ-#####'),
            'nombre' => $this->faker->word,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'marca' => $this->faker->company,
            'modelo' => $this->faker->word,
            'proveedor_id' => \App\Models\Proveedor::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
