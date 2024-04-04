<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Checkpoints;
use Illuminate\Support\Facades\DB;


class CheckpointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('checkpoints')->insert([
            'usuario_id' => 1,
            'gimcana_ubicaciones_id' => 1
        ]);
    }
}