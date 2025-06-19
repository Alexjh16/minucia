<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proyecto;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        Proyecto::create([
            'codigo' => 'BICM',
            'nombre' => 'Oceanografico',
        ]);
        Proyecto::create([
            'codigo' => 'BALC',
            'nombre' => 'Buque DA',
        ]);
        Proyecto::create([
            'codigo' => 'OPV',
            'nombre' => 'Offshore',
        ]);
        Proyecto::create([
            'codigo' => 'BRF',
            'nombre' => 'Recfluvial',
        ]);        
    }
}
