<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Likes;
use Illuminate\Support\Facades\DB;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('likes')->insert([
            'usuario_id' => 1,
            'ubicacion_id' => 1
        ]);

    }
}
