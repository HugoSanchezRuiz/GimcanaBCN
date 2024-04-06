<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUbicacion;

class TipoLocationController extends Controller
{
    public function getTipoLocations()
    {
        // Obtener todas las ubicaciones
        $tipolocations = TipoUbicacion::all();

        // Devolver las ubicaciones en formato JSON
        return response()->json($tipolocations);
    }

    public function destroy($id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = TipoUbicacion::findOrFail($id);
            
            // Eliminar la ubicación
            $location->delete();
            
            // Devolver una respuesta de éxito
            return response()->json('ok');
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error
            return response()->json(['error' => 'Error al eliminar el tipo de ubicación'], 500);
        }
    }
    

    public function edit($id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = TipoUbicacion::find($id);

            // Devolver la vista de edición con la ubicación
            return view('admin.edit', compact('location'));
        } catch (\Exception $e) {
            // Manejar cualquier error y redirigir con un mensaje de error
            return redirect()->view('admin.index')->with('error', 'Error al cargar el tipo de ubicación para editarla');
        }
    }


}
