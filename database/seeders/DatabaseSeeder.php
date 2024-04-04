<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CheckpointSeeder::class,
            tbl_usuarios::class,
            tbl_categorias::class,
            EtiquetaSeeder::class,
            GimcanaSeeder::class,
            GimcanaUbicacionSeeder::class,
            LikeSeeder::class,
            LobbiesSeeder::class,
            TipoUbicacionSeeder::class,
            UbicacionSeeder::class,
        ]);
    }
}
