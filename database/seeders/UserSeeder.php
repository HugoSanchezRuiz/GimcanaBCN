<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuario de ejemplo
        DB::table('users')->insert([
            'name' => 'Ejemplo Usuario',
            'email' => 'usuario@example.com',
            'password' => bcrypt('password'), // Ajusta la contraseña según sea necesario
            'tipo' => 'jugador', // Tipo de usuario
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('asdASD123'), // Ajusta la contraseña según sea necesario
            'tipo' => 'admin', // Tipo de usuario
        ]);
    }
}
