<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MapController;

use App\Http\Controllers\UbicacionController;

use App\Http\Controllers\LocationController;
use App\Http\Controllers\TipoLocationController;


Route::get('/admin', function () {
    return view('admin.index');
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







require __DIR__.'/auth.php';
