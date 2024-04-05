<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;

class LocationController extends Controller
{
    public function index()
    {
        // Obtener todas las ubicaciones
        $locations = Ubicacion::all();
        
        // Devolver la vista con las ubicaciones
        return view('admin.index', compact('locations'));
    }

    public function getLocations()
    {
        // Obtener todas las ubicaciones
        $locations = Ubicacion::all();
        
        // Devolver las ubicaciones en formato JSON
        return response()->json($locations);
    }
}

