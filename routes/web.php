<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TipoLocationController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.index');
});


Route::middleware('guest')->group(function () {
    Route::get('/', function () { return view('auth.login');});
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/ubicaciones', [LocationController::class, 'index'])->name('index');
Route::get('/get-locations', [LocationController::class, 'getLocations'])->name('getLocations');
Route::get('/get-tipo-ubicaciones', [TipoLocationController::class, 'getTipoLocations'])->name('getTipoLocations');
Route::delete('/ubicaciones/{id}', [LocationController::class, 'destroy'])->name('destroy');
Route::get('/ubicaciones/{id}/edit', [LocationController::class, 'edit'])->name('edit');

Route::delete('/tipo-ubicaciones/{id}', [TipoLocationController::class, 'destroy'])->name('destroy');
Route::get('/tipo-ubicaciones/{id}/edit', [TipoLocationController::class, 'edit'])->name('edit');


require __DIR__.'/auth.php';
