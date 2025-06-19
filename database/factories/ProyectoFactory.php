<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakeData = [
            'CodProyecto' => [
                'BICM',
                'BALC',
                'OPV',
                'BRF',
            ],
            'NombreProyecto' => [
                'Oceanografico',
                'Buque DA',
                'Offshore',
                'Recfluvial',
            ]
        ];
        return [
            'codigo' => $this->faker->unique()->randomElement($fakeData['CodProyecto']),
            'nombre' => $this->faker->randomElement($fakeData['NombreProyecto']),
        ];
    }
}
