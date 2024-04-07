<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Etiqueta;
use Illuminate\Support\Facades\DB;


class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etiquetas')->insert([
            'nombre' => 'Viaje2024'
        ]);
    }
}
