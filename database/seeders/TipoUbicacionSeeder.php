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
            'nombre' => 'Restaurante/Bar',
            'logo' => 'restaurante.png'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Transporte Publico',
            'logo' => 'buses.png'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Hotel',
            'logo' => 'hotel.png'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Parques',
            'logo' => 'parques.png'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Supermercados',
            'logo' => 'super.png'
        ]);

        DB::table('tipo_ubicaciones')->insert([
            'nombre' => 'Arte',
            'logo' => 'arte.png'
        ]);
    }
}