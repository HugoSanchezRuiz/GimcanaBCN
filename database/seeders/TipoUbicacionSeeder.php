<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TipoUbicacion;
use Illuminate\Support\Facades\DB;

class TipoUbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Tipo de Ubicacion de ejemplo'

        ]);
    }
}
