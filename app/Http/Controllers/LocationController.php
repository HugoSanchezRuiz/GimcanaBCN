<?php

namespace App\Http\Controllers;

use App\Models\TipoUbicacion;
use Illuminate\Http\Request;
use App\Models\Ubicacion;



class LocationController extends Controller
{
    // public function index()
    // {
    //     // Obtener todas las ubicaciones
    //     $locations = Ubicacion::all();

    //     // Devolver la vista con las ubicaciones
    //     return view('admin.index', compact('locations'));
    // }

    public function getLocations()
    {
        // Obtener todas las ubicaciones
        $locations = Ubicacion::all();

        // Devolver las ubicaciones en formato JSON
        return response()->json($locations);
    }

    public function destroy($id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = Ubicacion::findOrFail($id);
            
            // Eliminar la ubicación
            $location->delete();
            
            // Devolver una respuesta de éxito
            return response()->json('ok');
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error
            return response()->json(['error' => 'Error al eliminar la ubicación'], 500);
        }
    }
    

    public function edit($id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = Ubicacion::find($id);

            // Devolver la vista de edición con la ubicación
            return view('admin.edit', compact('location'));
        } catch (\Exception $e) {
            // Manejar cualquier error y redirigir con un mensaje de error
            return redirect()->view('admin.index')->with('error', 'Error al cargar la ubicación para editar');
        }
    }
}