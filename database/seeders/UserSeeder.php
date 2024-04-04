<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuarios de ejemplo
        User::create([
            'name' => 'Ivan',
            'email' => 'ivanmoreno@example.com',
            'password' => bcrypt('asdASD123'), // Ajusta la contraseña según sea necesario
        ]);
    }
}
