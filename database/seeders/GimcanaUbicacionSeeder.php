<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GimcanaUbicacion;

class GimcanaUbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear registros de GimcanaUbicacion de ejemplo
        // Por ejemplo:
        GimcanaUbicacion::create([
            'gimcana_id' => 1, // ID de la gimcana
            'ubicacion_id' => 1, // ID de la ubicación
            'orden' => 1, // Orden de la ubicación en la gimcana
        ]);
    }
}