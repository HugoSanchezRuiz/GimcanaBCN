<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones')->insert([
            'nombre' => 'Sagrada Familia',
            'calle' => 'Calle Ejemplo'

        ]);

    }
}
