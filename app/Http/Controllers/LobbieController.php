<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lobbies;
use App\Models\GimcanaUbicacion;

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

    public function obtenerPrimeraUbicacion(Request $request)
    {
        $lobbyId = $request->input('lobby_id'); // Obtener el ID de la lobby desde la solicitud
    
        // Consulta para obtener la primera ubicación de la gimcana
        $primeraUbicacion = GimcanaUbicacion::whereHas('ubicacion', function ($query) {
                $query->whereNotNull('Pista'); // Asegurarse de que la ubicación tenga una pista
            })
            ->where('gimcana_id', $lobbyId)
            ->orderBy('orden')
            ->first();
    
        if ($primeraUbicacion) {
            return response()->json(['pista' => $primeraUbicacion->ubicacion->Pista]);
        } else {
            return response()->json(['error' => 'No se encontró la primera ubicación de la gimcana o no tiene una pista asociada'], 404);
        }
    }
    
}    
