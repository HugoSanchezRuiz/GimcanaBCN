<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Lobbies;
use Illuminate\Support\Facades\DB;

class LobbiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lobbies')->insert([
            'usuario_id' => 1,
            'gimcana_id' => 1
        ]);
    }
}
