<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lobbies;

class LobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear lobbies de ejemplo
        // Por ejemplo:
        Lobbies::create([
            'usuario_id' => 1, // ID del usuario en el lobby
            'gimcana_id' => 1, // ID de la gimcana en la que está el lobby
        ]);
    }
}
