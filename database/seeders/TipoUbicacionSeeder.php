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
            'nombre' => 'Restaurante',
            'logo' => 'restaurante.jpg'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Bar',
            'logo' => 'bar.jpg'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Museo',
            'logo' => 'museo.jpg'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Hotel',
            'logo' => 'hotel.jpg'
        ]);
    }
}
