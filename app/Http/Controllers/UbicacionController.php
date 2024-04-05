<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function guardarUbicacion(Request $request)
    {
        dd($request->all()); // Verificar los datos recibidos
        // Obtener todos los datos del formulario
        $datos = $request->all();

        // Crear una nueva instancia de Ubicacion con los datos recibidos
        $ubicacion = new Ubicacion([
            'nombre' => $datos['nombre'],
            'calle' => $datos['calle'],
            'num_calle' => $datos['num_calle'],
            'ciudad' => $datos['ciudad'],
            'Pista' => '', // Dejarlo vacío como solicitaste
            'contador_likes' => 0, // Dejarlo vacío como solicitaste
            'tipo_ubicacion_id' => '', // Dejarlo vacío como solicitaste
            'latitud' => $datos['latitud'],
            'longitud' => $datos['longitud'],
        ]);

        // Guardar la ubicación en la base de datos
        $ubicacion->save();

        return response()->json(['message' => 'Ubicación guardada exitosamente']);
    }
}
