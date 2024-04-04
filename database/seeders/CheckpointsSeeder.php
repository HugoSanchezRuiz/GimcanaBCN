<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Checkpoints;

class CheckpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear checkpoints de ejemplo
        // Por ejemplo:
        Checkpoints::create([
            'usuario_id' => 1, // ID del usuario que completó el checkpoint
            'gimcana_ubicaciones_id' => 1, // ID de la ubicación de la gimcana
        ]);
    }
}