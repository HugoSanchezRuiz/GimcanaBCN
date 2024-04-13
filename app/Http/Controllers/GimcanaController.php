<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gimcana;
use App\Models\GimcanaUbicacion;
use App\Models\Ubicacion;

class GimcanaController extends Controller
{
    public function getGimcana()
    {
        // Obtener todas las ubicaciones y gimcanas
        $gimcana = Gimcana::all();
        $ubicaciones = GimcanaUbicacion::all();

        // Crear un array asociativo para contener ambas variables
        $data = [
            'gimcana' => $gimcana,
            'ubicaciones' => []
        ];

        // Obtener los nombres de las ubicaciones asociadas a cada gimcana
        foreach ($gimcana as $g) {
            $ubicacionesIds = $ubicaciones->where('gimcana_id', $g->id)->pluck('ubicacion_id')->toArray();
            $nombresUbicaciones = Ubicacion::whereIn('id', $ubicacionesIds)->pluck('nombre')->toArray();
            $data['ubicaciones'][$g->id] = $nombresUbicaciones;
        }

        // Devolver las variables en formato JSON
        return response()->json($data);
    }



    public function create(Request $request)
    {
        try {
            // Obtener el número total de gimcanas en la base de datos
            $totalGimcanas = Gimcana::count();

            // Generar el nombre único para la nueva gimcana
            $nombreGimcana = 'Gimcana ' . ($totalGimcanas + 1);

            // Crear una nueva instancia de Gimcana con el nombre generado
            $gimcana = new Gimcana();
            $gimcana->nombre_gimcana = $nombreGimcana;

            // Guardar la gimcana en la base de datos
            $gimcana->save();

            // Recoger el ID de la gimcana recién creada
            $gimcanaId = $gimcana->id;

            // Recoger los IDs de las ubicaciones seleccionadas
            $ubicacion1Id = $request->input('ubicacion1');
            $ubicacion2Id = $request->input('ubicacion2');
            $ubicacion3Id = $request->input('ubicacion3');

            // Crear registros en la tabla UbicacionGimcana
            $this->crearRegistroUbicacionGimcana($gimcanaId, $ubicacion1Id, 1);
            $this->crearRegistroUbicacionGimcana($gimcanaId, $ubicacion2Id, 2);
            $this->crearRegistroUbicacionGimcana($gimcanaId, $ubicacion3Id, 3);

            // Devolver una respuesta JSON indicando éxito y un mensaje
            // return response()->json('ok');
            return response()->json(['message' => 'Gimcana se ha creado correctamente'], 200);
        } catch (\Exception $e) {
            dd($e);
            // Manejar cualquier error y devolver una respuesta JSON indicando el error
            return response()->json(['success' => false, 'message' => 'Hubo un problema al crear la gimcana. Por favor, inténtalo de nuevo.'], 500);
        }
    }

    public function crearRegistroUbicacionGimcana($gimcanaId, $ubicacionId, $orden)
    {
        $gimcanaUbi = new GimcanaUbicacion();
        $gimcanaUbi->gimcana_id = $gimcanaId;
        $gimcanaUbi->ubicacion_id = $ubicacionId;
        $gimcanaUbi->orden = $orden;

        // Intenta guardar el registro en la base de datos
        if ($gimcanaUbi->save()) {
            // Si el guardado es exitoso, puedes realizar alguna acción adicional o simplemente devolver true
            return true;
        } else {
            // Si el guardado falla, lanza una excepción con un mensaje de error
            throw new \Exception('Error al enlazar la ubicación con la gimcana.');
        }
    }

    public function deleteGimcana($id) {
        try {
            // Encuentra la gimcana por su ID
            $gimcana = Gimcana::findOrFail($id);
    
            // Elimina la gimcana
            $gimcana->delete();
    
            // Devuelve una respuesta JSON indicando éxito (sin mensaje adicional)
            return response()->json([], 200);
        } catch (\Exception $e) {
            // Maneja cualquier error y devuelve una respuesta JSON indicando el error
            return response()->json(['success' => false, 'message' => 'Hubo un problema al eliminar la gimcana. Por favor, inténtalo de nuevo.'], 500);
        }
    }
    
    


    public function getUbicaciones()
    {
        // Obtener todas las ubicaciones
        $ubicaciones = Ubicacion::all();

        // Devolver las ubicaciones en formato JSON
        return response()->json($ubicaciones);
    }
}
