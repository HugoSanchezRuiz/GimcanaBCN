<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GimcanaUbicacion;

class GimcanaUbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gimcana_ubicaciones')->insert([
            'gimcana_id' => 1,
            'ubicacion_id' => 13,
            'orden' => '1'
        ]);
        DB::table('gimcana_ubicaciones')->insert([
            'gimcana_id' => 1,
            'ubicacion_id' => 14,
            'orden' => '2'
        ]);
        DB::table('gimcana_ubicaciones')->insert([
            'gimcana_id' => 1,
            'ubicacion_id' => 15,
            'orden' => '3'
        ]);

    }
}