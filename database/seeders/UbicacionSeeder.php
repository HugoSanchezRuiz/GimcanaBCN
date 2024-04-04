<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear ubicaciones de ejemplo
        // Por ejemplo:
        Ubicacion::create([
            'nombre' => 'Sagrada Familia',
            'calle' => 'Calle Ejemplo',
            // Ajustar con más datos según sea necesario
        ]);
    }
}
