<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function guardarUbicacion(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
        ]);

        // Crear una nueva instancia de Ubicacion con los datos recibidos
        $ubicacion = new Ubicacion([
            'nombre' => $request->input('nombre'),
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
            // Puedes agregar otros campos aquí si es necesario
        ]);

        // Guardar la ubicación en la base de datos
        $ubicacion->save();

        // Retornar una respuesta JSON indicando que la ubicación fue guardada exitosamente
        return response()->json(['message' => 'Ubicación guardada exitosamente']);
    }
}
