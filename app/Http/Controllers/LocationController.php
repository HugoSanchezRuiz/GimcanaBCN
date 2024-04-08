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
            $location = Ubicacion::find($id);

            // Buscar la relación en GimcanaUbicacion por el ID de la ubicación
            $relation = GimcanaUbicacion::where('ubicacion_id', $id)->first();

            // Verificar si la relación existe
            if ($relation) {
                // Eliminar la relación en GimcanaUbicacion
                $relation->delete();
            }

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
    
            // Verificar si se encontró la ubicación
            if (!$location) {
                return response()->json(['error' => 'La ubicación no fue encontrada'], 404);
            }
    
            $tipoUbicaciones = TipoUbicacion::all();
    
            // Verificar si se encontraron tipos de ubicaciones
            if ($tipoUbicaciones->isEmpty()) {
                return response()->json(['error' => 'No se encontraron tipos de ubicación'], 404);
            }
    
            // Crear un array para almacenar las opciones de tipo de ubicación
            $options = [];
            foreach ($tipoUbicaciones as $tipoUbicacion) {
                $options[] = [
                    'id' => $tipoUbicacion->id,
                    'nombre' => $tipoUbicacion->nombre
                ];
            }
    
            // Devolver los datos de la ubicación y el tipo de ubicación en formato JSON
            return response()->json([
                'location' => $location,
                'tipoUbicaciones' => $options
            ]);
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