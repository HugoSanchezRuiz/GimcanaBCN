<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lobbies;
use Illuminate\Support\Facades\DB;

class LobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codigo = $this->generarCodigo();

        DB::table('lobbies')->insert([
            'nombre_lobby' => 'Lobby',
            'gimcana_id' => 1, // Id de la gimcana correspondiente
            'lobbies_codigo' => $codigo,
            'estado' => 'libre'
        ]);
    }

        // Función para generar un código aleatorio de 4 dígitos y único
        private function generarCodigo()
        {
            $codigo = mt_rand(1000, 9999);
    
            $exists = Lobbies::where('lobbies_codigo', $codigo)->exists();
    
            // generar uno nuevo hasta que se encuentre uno que no esté
            while ($exists) {
                $codigo = mt_rand(1000, 9999);
                $exists = Lobbies::where('lobbies_codigo', $codigo)->exists();
            }
    
            return $codigo;
        }
}
