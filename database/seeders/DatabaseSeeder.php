<?php

namespace Database\Seeders;

use App\Models\LobbiesUser;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);

        $this->call(EtiquetaSeeder::class);
 
        $this->call(GimcanaSeeder::class);

        $this->call(LobbiesSeeder::class);

        $this->call(LobbiesUserSeeder::class);

        $this->call(TipoUbicacionSeeder::class);
  
        $this->call(UbicacionSeeder::class);

        $this->call(LikesSeeder::class);

        $this->call(GimcanaUbicacionSeeder::class);

        $this->call(CheckpointsSeeder::class);
    }
}
