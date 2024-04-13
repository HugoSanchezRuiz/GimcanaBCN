<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserta los registros en la tabla 'user_etiqueta'
        DB::table('user_etiqueta')->insert([
            [
                'user_id' => 1, // ID del usuario
                'etiqueta_id' => 1, // ID de la etiqueta
            ],
        ]);
    }
}