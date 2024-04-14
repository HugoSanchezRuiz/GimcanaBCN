<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MapController;

use App\Http\Controllers\UbicacionController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\TipoLocationController;
use App\Http\Controllers\GimcanaController;
use App\Http\Controllers\LikeController;

use App\Http\Controllers\LobbieController;


Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/gimcana', function () {
    return view('gimcana');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin', [MapController::class, 'index'])->name('admin.index');

Route::get('/gimcana', [MapController::class, 'gimcana'])->name('gimcana');


Route::post('/guardar-ubicacion', [UbicacionController::class, 'guardarUbicacion'])->name('guardar-ubicacion');


// Route::get('/admin', [LocationController::class, 'index'])->name('admin.index');
Route::get('/get-locations', [LocationController::class, 'getLocations'])->name('getLocations');
Route::get('/get-tipo-ubicaciones', [TipoLocationController::class, 'getTipoLocations'])->name('getTipoLocations');
Route::delete('/ubicaciones/{id}', [LocationController::class, 'destroy'])->name('destroy');
Route::get('/ubicaciones/{id}/edit', [LocationController::class, 'edit'])->name('edit');
Route::post('/ubicaciones/{id}/update', [LocationController::class, 'update'])->name('update');



Route::delete('/tipo-ubicaciones/{id}', [TipoLocationController::class, 'destroy'])->name('destroy');
Route::get('/tipo-ubicaciones/{id}/edit', [TipoLocationController::class, 'edit'])->name('edit');
Route::post('/tipo-ubicaciones/{id}/update', [TipoLocationController::class, 'update'])->name('update');
Route::post('/tipo-ubicaciones/create', [TipoLocationController::class, 'create'])->name('create');

// Ruta para obtener las gimcanas
Route::get('/get-gimcanas', [GimcanaController::class, 'index']);

// Ruta para editar una gimcana
Route::get('/gimcanas/{id}/edit', [GimcanaController::class, 'edit']);


Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('auth.login');});
    // Route::get('/mapa', function () { return view ('auth.mapa');});
    Route::get('/mapa', [MapController::class, 'user'])->name('auth.mapa'); // <- Esto debería estar en AUTH
    // Route::post('/mapa', [SalaController::class, 'crearSala'])->name('auth.mapa'); // <- Necesitamos tabla intermedia
    Route::post('/mapa/like', [LikeController::class, 'like'])->name('auth.mapa');
    Route::post('/mapa/unlike', [LikeController::class, 'eliminarLike'])->name('auth.mapa');
});



// Rutas para manejar las lobbies
Route::get('/gimcana', [LobbieController::class, 'mostrarGimcana'])->name('gimcana.mostrar');



Route::post('/cerrar-lobby', [LobbieController::class, 'cerrarLobby'])->name('lobby.cerrar');

Route::post('/obtener-ubicacion', [LobbieController::class, 'obtenerUbicacion'])->name('obtener-ubicacion');

Route::post('/obtener-ubicacion-dos', [LobbieController::class, 'obtenerUbicacionDos'])->name('obtener-ubicacion-dos');

Route::post('/obtener-ubicacion-tres', [LobbieController::class, 'obtenerUbicacionTres'])->name('obtener-ubicacion-tres');




require __DIR__.'/auth.php';
