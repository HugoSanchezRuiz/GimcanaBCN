<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lobbies;
use App\Models\GimcanaUbicacion;
use App\Models\Ubicacion;

class LobbieController extends Controller
{
    public function mostrarGimcana()
    {
        $usuarioId = 1; // Usuario con usuario_id=1
        $lobby = Lobbies::where('id', $usuarioId)->first(); // Obtener la lobby del usuario
        $usuariosGrupo = $lobby->usuarios; // Obtener los usuarios en el grupo de la lobby

        return view('gimcana', compact('lobby', 'usuariosGrupo'));
    }

    public function cerrarLobby(Request $request)
    {
        $lobbyId = $request->input('lobby_id');
        $lobby = Lobbies::findOrFail($lobbyId);
        // Aquí puedes agregar lógica para cerrar la lobby, por ejemplo:
        $lobby->estado = 'ocupada';
        $lobby->save();

        return response()->json(['message' => 'Lobby cerrada exitosamente']);
    }

    public function obtenerUbicacion(Request $request)
    {
        $idUbicacion = 13; // ID de la ubicación que deseas obtener
    
        // Consulta para obtener la ubicación por su ID
        $ubicacion = Ubicacion::select('latitud', 'longitud', 'Pista')->find($idUbicacion);
    
        if ($ubicacion) {
            return response()->json($ubicacion);
        } else {
            return response()->json(['error' => 'No se encontró la ubicación con el ID proporcionado'], 404);
        }
    }

    public function obtenerUbicacionDos(Request $request)
    {
        $idUbicacion = 14; // ID de la ubicación que deseas obtener
    
        // Consulta para obtener la ubicación por su ID
        $ubicacion = Ubicacion::select('latitud', 'longitud', 'Pista')->find($idUbicacion);
    
        if ($ubicacion) {
            return response()->json($ubicacion);
        } else {
            return response()->json(['error' => 'No se encontró la ubicación con el ID proporcionado'], 404);
        }
    }

    public function obtenerUbicacionTres(Request $request)
    {
        $idUbicacion = 15; // ID de la ubicación que deseas obtener
    
        // Consulta para obtener la ubicación por su ID
        $ubicacion = Ubicacion::select('latitud', 'longitud', 'Pista')->find($idUbicacion);
    
        if ($ubicacion) {
            return response()->json($ubicacion);
        } else {
            return response()->json(['error' => 'No se encontró la ubicación con el ID proporcionado'], 404);
        }
    }
    
}
