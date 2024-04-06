<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Ubicacion;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sagrada Familia
        DB::table('ubicaciones')->insert([
            'nombre' => 'Sagrada Familia',
            'calle' => 'Calle Mallorca',
            'num_calle' => '401',
            'codigo_postal' => '08013',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista de la Sagrada Familia',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.4036',
            'longitud' => '2.1744',
            'descripcion' => 'Descripción de la Sagrada Familia',
            'imagen' => 'sagradafamilia.jpg',
        ]);

        // Parque Güell
        DB::table('ubicaciones')->insert([
            'nombre' => 'Parque Güell',
            'calle' => 'Calle Olot',
            'num_calle' => '7',
            'codigo_postal' => '08024',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista del Parque Güell',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.4145',
            'longitud' => '2.1527',
            'descripcion' => 'Descripción del Parque Güell',
            'imagen' => 'parquegay.jpg',
        ]);

        // La Rambla
        DB::table('ubicaciones')->insert([
            'nombre' => 'La Rambla',
            'calle' => 'La Rambla',
            'num_calle' => '',
            'codigo_postal' => '08002',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista de La Rambla',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3809',
            'longitud' => '2.1734',
            'descripcion' => 'Descripción de La Rambla',
            'imagen' => 'larambla.jpg',
        ]);

        // Camp Nou
        DB::table('ubicaciones')->insert([
            'nombre' => 'Camp Nou',
            'calle' => 'Calle Aristides Maillol',
            'num_calle' => '',
            'codigo_postal' => '08028',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista del Camp Nou',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3809',
            'longitud' => '2.1228',
            'descripcion' => 'Descripción del Camp Nou',
            'imagen' => 'campnou.jpg',
        ]);

        // Barrio Gótico
        DB::table('ubicaciones')->insert([
            'nombre' => 'Barrio Gótico',
            'calle' => 'Calle Santa Anna',
            'num_calle' => '',
            'codigo_postal' => '08002',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista del Barrio Gótico',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3833',
            'longitud' => '2.1764',
            'descripcion' => 'Descripción del Barrio Gótico',
            'imagen' => 'ruta/de/la/imagen.jpg',
        ]);

        // Casa Batlló
        DB::table('ubicaciones')->insert([
            'nombre' => 'Casa Batlló',
            'calle' => 'Passeig de Gràcia',
            'num_calle' => '43',
            'codigo_postal' => '08007',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista de la Casa Batlló',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3916',
            'longitud' => '2.1649',
            'descripcion' => 'Descripción de la Casa Batlló',
            'imagen' => 'ruta/de/la/imagen.jpg',
        ]);

        // Mercado de la Boquería
        DB::table('ubicaciones')->insert([
            'nombre' => 'Mercado de la Boquería',
            'calle' => 'La Rambla',
            'num_calle' => '',
            'codigo_postal' => '08001',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista del Mercado de la Boquería',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3801',
            'longitud' => '2.1729',
            'descripcion' => 'Descripción del Mercado de la Boquería',
            'imagen' => 'ruta/de/la/imagen.jpg',
        ]);

        // Montjuïc
        DB::table('ubicaciones')->insert([
            'nombre' => 'Montjuïc',
            'calle' => '',
            'num_calle' => '',
            'codigo_postal' => '',
            'ciudad' => 'Barcelona',
            'Pista' => 'Pista de Montjuïc',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3646',
            'longitud' => '2.1562',
            'descripcion' => 'Descripción de Montjuïc',
            'imagen' => 'ruta/de/la/imagen.jpg',
        ]);
    }
}