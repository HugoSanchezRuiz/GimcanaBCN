<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    public function guardarUbicacion(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric',
            'calle' => 'nullable|string',
            'num_calle' => 'nullable|string',
            'codigo_postal' => 'nullable|string',
            'ciudad' => 'nullable|string',
        ]);
    
        $ubicacion = new Ubicacion([
            'nombre' => $request->input('nombre'),
            'latitud' => $request->input('latitud'),
            'longitud' => $request->input('longitud'),
            'calle' => $request->input('calle'),
            'num_calle' => $request->input('num_calle'),
            'codigo_postal' => $request->input('codigo_postal'),
            'ciudad' => $request->input('ciudad'),
        ]);
    
        $ubicacion->save();
    
        return response()->json(['message' => 'Ubicación guardada exitosamente']);
    }
}
