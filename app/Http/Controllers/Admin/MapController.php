<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ubicacion; 
use App\Models\TipoUbicacion;

class MapController extends Controller
{
    public function index()
    {
        // Obtener todas las ubicaciones de la base de datos
        $ubicaciones = Ubicacion::all();
        
        // Obtener todos los tipos de ubicación de la base de datos
        $tiposUbicacion = TipoUbicacion::all();

        // Pasar las ubicaciones y los tipos de ubicación a la vista
        return view('admin.index', compact('ubicaciones', 'tiposUbicacion'));
    }

    public function gimcana()
    {
        // Obtener todas las ubicaciones de la base de datos
        $ubicaciones = Ubicacion::all();
        
        // Obtener todos los tipos de ubicación de la base de datos
        $tiposUbicacion = TipoUbicacion::all();

        // Pasar las ubicaciones y los tipos de ubicación a la vista
        return view('gimcana', compact('ubicaciones', 'tiposUbicacion'));
    }
    
    public function user(){
        $userID = 1; // <-- PRUEBA
        // Obtener todas las ubicaciones de la base de datos
        $ubicaciones = Ubicacion::select('ubicaciones.*')
        ->selectRaw('CASE WHEN likes.usuario_id IS NOT NULL THEN 1 ELSE 0 END AS ha_dado_like')
        ->leftJoin('likes', function($join) use ($userID) {
            $join->on('ubicaciones.id', '=', 'likes.ubicacion_id')
                 ->where('likes.usuario_id', '=', $userID);
        })
        ->get();

        // dd($ubicaciones);

        // Pasar las ubicaciones a la vista
        return view('auth.mapa', compact('ubicaciones'));
    }
}

