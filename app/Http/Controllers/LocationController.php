<?php

namespace App\Http\Controllers;

use App\Models\TipoUbicacion;
use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\GimcanaUbicacion;



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
        // Obtener todas las ubicaciones con sus tipos de ubicación relacionados
        $locations = Ubicacion::with('tipoUbicacion')->get();

        // Devolver las ubicaciones en formato JSON
        return response()->json($locations);
    }


    public function destroy($id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = Ubicacion::findOrFail($id);
            $relacion = GimcanaUbicacion::find($id);

            // Eliminar la ubicación
            $relacion->delete();
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

            // Devolver los datos de la ubicación en formato JSON
            return response()->json($location);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error en JSON
            return response()->json(['error' => 'Error al obtener los datos de la ubicación'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Buscar la ubicación por su ID
            $location = Ubicacion::find($id);

            // Actualizar los datos de la ubicación con los datos del formulario
            $location->nombre = $request->input('nombre');
            $location->calle = $request->input('calle');
            $location->num_calle = $request->input('num_calle');
            $location->codigo_postal = $request->input('codigo_postal');
            $location->ciudad = $request->input('ciudad');
            $location->pista = $request->input('pista');
            $location->contador_likes = $request->input('contador_likes');
            $location->tipo_ubicacion_id = $request->input('tipo_ubicacion_id');
            $location->latitud = $request->input('latitud');
            $location->longitud = $request->input('longitud');
            $location->descripcion = $request->input('descripcion');
            $location->imagen = $request->input('imagen');

            // Guardar los cambios
            $location->save();

            // Devolver una respuesta JSON de éxito
            return response()->json(['message' => 'Ubicación actualizada correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta JSON de error
            return response()->json(['error' => 'Error al actualizar la ubicación'], 500);
        }
    }
}
