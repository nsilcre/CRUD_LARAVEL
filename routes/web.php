<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// AGREGA ESTAS LÍNEAS:
use App\Http\Controllers\VehiculoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('vehiculos', VehiculoController::class);
});

require __DIR__ . '/auth.php';
