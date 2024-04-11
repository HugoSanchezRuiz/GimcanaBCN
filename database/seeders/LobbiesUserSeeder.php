<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LobbiesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lobbies_user')->insert([
            'lobby_id' => 1,
            'usuario_id' => 1,
        ]);

        DB::table('lobbies_user')->insert([
            'lobby_id' => 1,
            'usuario_id' => 2,
        ]);
    }
}
