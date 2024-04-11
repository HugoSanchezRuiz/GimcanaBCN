<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion; // Asegúrate de importar el modelo Ubicacion aquí
use App\Models\Gimcana;

class GimcanaController extends Controller
{
    // Método para obtener todas las gimcanas con sus ubicaciones
    public function index()
    {
        $gimcanas = Gimcana::with('ubicaciones2')->get();
        return view('gimcanas.index', compact('gimcanas'));
    }

    // Método para obtener los datos de una gimcana específica para la edición
    public function edit($id)
    {
        $gimcana = Gimcana::with('ubicaciones2')->find($id);
        return response()->json($gimcana);
    }
    
    public function show($id) {
        $gimcana = Gimcana::findOrFail($id);
        // Otros datos que quieras pasar a la vista
        return view('gimcana', ['gimcana' => $gimcana]);
    }
    
}
