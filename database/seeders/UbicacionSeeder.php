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
            'tipo_ubicacion_id' => 6,
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
            'tipo_ubicacion_id' => 4,
            'latitud' => '41.4145',
            'longitud' => '2.1527',
            'descripcion' => 'Descripción del Parque Güell',
            'imagen' => 'parquegay.jpg',
        ]);


        DB::table('ubicaciones')->insert([
            'nombre' => 'Restaurante El Centro',
            'calle' => 'Calle Mayor',
            'num_calle' => '123',
            'codigo_postal' => '08901',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista de Restaurante El Centro',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1,
            'latitud' => '41.3597',
            'longitud' => '2.1081',
            'descripcion' => 'Un acogedor restaurante en el corazón de Hospitalet Centro.',
            'imagen' => 'restaurante_el_centro.jpg',
        ]);

        // Transporte Público en Hospitalet Centro
        DB::table('ubicaciones')->insert([
            'nombre' => 'Estación de Autobuses Hospitalet',
            'calle' => 'Avenida de Barcelona',
            'num_calle' => '456',
            'codigo_postal' => '08902',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista de Estación de Autobuses Hospitalet',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 2,
            'latitud' => '41.3618',
            'longitud' => '2.1053',
            'descripcion' => 'La principal estación de autobuses de Hospitalet Centro.',
            'imagen' => 'estacion_autobuses_hospitalet.jpg',
        ]);

        // Hotel en Hospitalet Centro
        DB::table('ubicaciones')->insert([
            'nombre' => 'Hotel Plaza Central',
            'calle' => 'Plaza del Ayuntamiento',
            'num_calle' => '1',
            'codigo_postal' => '08903',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista del Hotel Plaza Central',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 3,
            'latitud' => '41.3632',
            'longitud' => '2.1037',
            'descripcion' => 'Un elegante hotel en la plaza central de Hospitalet Centro.',
            'imagen' => 'hotel_plaza_central.jpg',
        ]);

        // Parque en Hospitalet Centro
        DB::table('ubicaciones')->insert([
            'nombre' => 'Parque de la Libertad',
            'calle' => 'Avenida de la Libertad',
            'num_calle' => '',
            'codigo_postal' => '08904',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista del Parque de la Libertad',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 4,
            'latitud' => '41.3574',
            'longitud' => '2.1122',
            'descripcion' => 'Un amplio parque donde disfrutar del aire libre en Hospitalet Centro.',
            'imagen' => 'parque_de_la_libertad.jpg',
        ]);

        // Supermercado en Hospitalet Centro
        DB::table('ubicaciones')->insert([
            'nombre' => 'Supermercado Central',
            'calle' => 'Calle del Mercado',
            'num_calle' => '987',
            'codigo_postal' => '08905',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista del Supermercado Central',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 5,
            'latitud' => '41.3605',
            'longitud' => '2.1078',
            'descripcion' => 'El supermercado más grande y completo de Hospitalet Centro.',
            'imagen' => 'supermercado_central.jpg',
        ]);
                // Parque de la Serpiente en Hospitalet de Llobregat
                DB::table('ubicaciones')->insert([
                    'nombre' => 'Parque de la Serpiente',
                    'calle' => 'Avenida del Carrilet',
                    'num_calle' => 'S/N',
                    'codigo_postal' => '08907',
                    'ciudad' => 'Hospitalet de Llobregat',
                    'Pista' => 'Pista del Parque de la Serpiente',
                    'contador_likes' => 0,
                    'tipo_ubicacion_id' => 4, // Tipo de ubicación: Parque
                    'latitud' => '41.3625',
                    'longitud' => '2.1139',
                    'descripcion' => 'El Parque de la Serpiente es un amplio espacio verde ubicado en Hospitalet de Llobregat. Ofrece áreas de recreación, zonas verdes y senderos para caminar.',
                    'imagen' => 'parque_serpiente.jpg', // Ruta de la imagen del parque
                ]);
                        // Parada de Metro Avinguda Carrilet
        DB::table('ubicaciones')->insert([
            'nombre' => 'Parada de Metro Avinguda Carrilet',
            'calle' => 'Avinguda Carrilet',
            'num_calle' => 'S/N',
            'codigo_postal' => '08907',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista de la parada de Metro Avinguda Carrilet',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 2, // Tipo de ubicación: Transporte Público
            'latitud' => '41.361812',
            'longitud' => '2.122992',
            'descripcion' => 'La parada de metro Avinguda Carrilet es una estación de la línea L5 del metro de Barcelona. Está ubicada en Hospitalet de Llobregat, cerca del centro de la ciudad.',
            'imagen' => 'parada_metro_avcarrilet.jpg', // Ruta de la imagen de la parada de metro
        ]);

        // Restaurante cercano a la parada de metro
        DB::table('ubicaciones')->insert([
            'nombre' => 'Restaurante El Encanto',
            'calle' => 'Carrer de Sant Ferran',
            'num_calle' => '12',
            'codigo_postal' => '08907',
            'ciudad' => 'Hospitalet de Llobregat',
            'Pista' => 'Pista del Restaurante El Encanto',
            'contador_likes' => 0,
            'tipo_ubicacion_id' => 1, // Tipo de ubicación: Restaurante/Bar
            'latitud' => '41.362273',
            'longitud' => '2.122864',
            'descripcion' => 'El Restaurante El Encanto es un acogedor establecimiento ubicado cerca de la parada de metro Avinguda Carrilet. Ofrece una variedad de platos caseros y especialidades locales.',
            'imagen' => 'restaurante_encanto.jpg', // Ruta de la imagen del restaurante
        ]);
    }
}
