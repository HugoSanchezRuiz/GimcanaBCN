<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ubicacion; 

class MapController extends Controller
{
    public function index()
    {
        // Obtener todas las ubicaciones de la base de datos
        $ubicaciones = Ubicacion::all();

        // dd($ubicaciones);
        
        // Pasar las ubicaciones a la vista
        return view('admin.index', compact('ubicaciones'));
    }
}
