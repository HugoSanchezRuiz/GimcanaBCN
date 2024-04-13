<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtiquetasUbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserta los registros en la tabla 'etiquetas_ubicaciones'
        DB::table('etiquetas_ubicaciones')->insert([
            [
                'nombre' => 'Ejemplo Etiqueta 1', // Nombre de la etiqueta
                'etiqueta_id' => 1, // ID de la etiqueta (si ya existe una tabla de etiquetas)
                'ubicacion_id' => 1, // ID de la ubicación
            ],
        ]);
    }
}