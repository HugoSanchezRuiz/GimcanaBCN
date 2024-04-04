<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\Models\Gimcana;

class GimcanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gimcana')->insert([
            'nombre_gimcana' => 'Gimcana Prueba'
        ]);

    }
}
