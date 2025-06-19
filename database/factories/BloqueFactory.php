<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bloque>
 */
class BloqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeData = [
            //adicional al identificador del bloque
            'CodBloque' => [
                '130-1110',
                '135-1110',
                '130-3510',
                '130-3610',
                '135-3310',
                '100-2210'
            ],
            'NombreBloque' => [
                '1110',
                '2210',
                '3510',
                '3610',
                '3310',
                '2210'
            ]
        ];
        return [
            'codigo' => $this->faker->unique()->randomElement($fakeData['CodBloque']),
            'nombre' => $this->faker->randomElement($fakeData['NombreBloque']),
            'proyecto_id' => \App\Models\Proyecto::factory()->create()->id,
        ];
    }
}
