<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etiqueta;

class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear etiquetas de ejemplo
        // Por ejemplo:
        Etiqueta::create([
            'nombre' => 'Viaje2024',
        ]);
    }
}
