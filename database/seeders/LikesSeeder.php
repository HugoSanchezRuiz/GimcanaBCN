<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Likes;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear likes de ejemplo
        // Por ejemplo:
        Likes::create([
            'usuario_id' => 1, // ID del usuario que dio like
            'ubicacion_id' => 1, // ID de la ubicación que recibió el like
        ]);
    }
}
