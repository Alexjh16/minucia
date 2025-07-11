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
            //precio cerrado sin decimales
            'precio' => $this->faker->numberBetween(50, 10000),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'marca' => $this->faker->company,
            'modelo' => $this->faker->word,
            'bloque_id' => \App\Models\Bloque::factory()->create()->id,
            'user_id' => \App\Models\User::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),

            //nuevos campos
            'peso_teorico' => $this->faker->numberBetween(1, 100),
            'peso_real' => $this->faker->numberBetween(1, 100),
            'bloque_id' => \App\Models\Bloque::factory()->create()->id,
        ];
    }
}
