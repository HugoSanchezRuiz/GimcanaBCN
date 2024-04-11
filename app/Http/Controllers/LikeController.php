<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes; 
use App\Models\Ubicacion;

class LikeController extends Controller
{

    public function like(Request $request)
    {
        // Verificar si el usuario ya ha dado "Me gusta" a la ubicación
        $like = Likes::where('usuario_id', $request->usuario_id) // 'usuario_id', auth()->id()) <-- SE DEBE PONER ASÍ
                     ->where('ubicacion_id', $request->ubicacion_id)
                     ->first();

        if (!$like) {
            // Si el usuario aún no ha dado "Me gusta", lo agregamos
            Likes::create([
                // 'usuario_id' => auth()->id(), <-- ASÍ ES COMO SE DEBE PONER
                'usuario_id' => $request->usuario_id, // <-- PRUEBA
                'ubicacion_id' => $request->ubicacion_id
            ]);
        }

        return response()->json(['message' => 'Has dado "Me gusta" a la ubicación.']);
    }

    public function eliminarLike(Request $request)
    {
        // Verificar si el usuario ya ha dado "Me gusta" a la ubicación
        $like = Likes::where(
                    // 'usuario_id', auth()->id()) <-- ASÍ ES COMO SE DEBE PONER
                    'usuario_id', $request->usuario_id) // <-- PRUEBA
                     ->where('ubicacion_id', $request->ubicacion_id)
                     ->first();

        if ($like) {
            // Si el usuario ha dado "Me gusta", lo eliminamos
            $like->delete();
        }

        return response()->json(['message' => 'Has eliminado tu "Me gusta" de la ubicación.']);
    }
}