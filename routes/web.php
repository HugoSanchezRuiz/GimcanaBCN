<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/ubicaciones', [LocationController::class, 'index'])->name('ubicaciones.index');
Route::get('/get-locations', [LocationController::class, 'getLocations'])->name('ubicaciones.get');


require __DIR__.'/auth.php';
