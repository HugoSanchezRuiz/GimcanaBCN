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
            // Buscar el tipo de ubicación por su ID
            $tipoUbicacion = TipoUbicacion::find($id);

            // Devolver los datos del tipo de ubicación en formato JSON
            return response()->json($tipoUbicacion);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta de error en JSON
            return response()->json(['error' => 'Error al obtener los datos del tipo de ubicación'], 500);
        }
    }

public function update(Request $request, $id)
{
    try {
        // Buscar el tipo de ubicación por su ID
        $tipoUbicacion = TipoUbicacion::find($id);

        // Verificar si el tipo de ubicación existe
        if (!$tipoUbicacion) {
            return response()->json(['error' => 'El tipo de ubicación no existe'], 404);
        }

        // Actualizar los datos del tipo de ubicación con los datos del formulario
        $tipoUbicacion->nombre = $request->input('nombre');
        
        // Verificar si se proporciona una nueva imagen
        if ($request->hasFile('logo')) {
            // Obtener el archivo de imagen del formulario
            $image = $request->file('logo');

            // Generar un nombre único para la nueva imagen
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la nueva imagen al directorio deseado dentro de /public/img
            $image->move(public_path('img'), $imageName);

            // Asignar el nombre de la nueva imagen al atributo 'logo'
            $tipoUbicacion->logo = $imageName;
        }

        // Guardar los cambios
        $tipoUbicacion->save();

        // Devolver una respuesta JSON de éxito
        return response()->json(['message' => 'Tipo de ubicación actualizado correctamente'], 200);
    } catch (\Exception $e) {
        // Manejar cualquier error y devolver una respuesta JSON de error
        return response()->json(['error' => 'Error al actualizar el tipo de ubicación'], 500);
    }
}


    public function create(Request $request)
    {
        try {
            // Crear un nuevo tipo de ubicación con los datos del formulario
            $tipoUbicacion = new TipoUbicacion();
            $tipoUbicacion->nombre = $request->input('nombre');

            // Obtener el archivo de imagen del formulario
            $image = $request->file('logo');

            // Generar un nombre único para la imagen
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Mover la imagen al directorio deseado dentro de /public/img
            $image->move(public_path('img'), $imageName);

            // Asignar el nombre de la imagen al atributo 'logo'
            $tipoUbicacion->logo = $imageName;

            // Guardar el nuevo tipo de ubicación en la base de datos
            $tipoUbicacion->save();

            // Devolver una respuesta JSON de éxito
            return response()->json(['message' => 'Tipo de ubicación creado correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar cualquier error y devolver una respuesta JSON de error
            return response()->json(['error' => 'Error al crear el tipo de ubicación'], 500);
        }
    }
}
