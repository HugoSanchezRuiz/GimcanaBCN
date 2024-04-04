<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TipoUbicacion;

class TipoUbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear tipos de ubicación de ejemplo
        // Por ejemplo:
        TipoUbicacion::create([
            'nombre' => 'Tipo de Ubicacion de ejemplo',
            // Ajustar con más datos según sea necesario
        ]);
    }
}
