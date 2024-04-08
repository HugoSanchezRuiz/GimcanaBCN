<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ubicacion; 
use App\Models\TipoUbicacion;

class MapController extends Controller
{
    public function index()
    {
        // Obtener todas las ubicaciones de la base de datos
        $ubicaciones = Ubicacion::all();
        
        // Obtener todos los tipos de ubicación de la base de datos
        $tiposUbicacion = TipoUbicacion::all();

        // Pasar las ubicaciones y los tipos de ubicación a la vista
        return view('admin.index', compact('ubicaciones', 'tiposUbicacion'));
    }
}

