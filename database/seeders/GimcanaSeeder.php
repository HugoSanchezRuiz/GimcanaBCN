<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gimcana;

class GimcanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear una gimcana de ejemplo
        Gimcana::create([
            'nombre_gimcana' => 'Gimcana Prueba',
        ]);
    }
}
