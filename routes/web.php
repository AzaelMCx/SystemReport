<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DatosPostesController;
//use App\Http\Controllers\CamerasDataController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [CameraController::class, 'index'])->name('dashboard');
    Route::resource('cameras', CameraController::class);
    Route::resource('reports', ReportController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/history', [ReportController::class, 'history'])->name('history');
    Route::get('/cameras/{id}/download-reports', [ReportController::class, 'downloadCameraReports'])->name('cameras.downloadReports');

    Route::post('/reports/{id}/update-status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::get('/datos-postes', [DatosPostesController::class, 'index'])->name('datosPostes.index');

    // Rutas de DatosPostes
    Route::get('/datos-postes', [DatosPostesController::class, 'index'])->name('datosPostes.index');
    Route::get('/datos-postes/{id}/edit', [DatosPostesController::class, 'edit'])->name('datosPostes.edit');
    Route::resource('datosPostes', DatosPostesController::class);
    Route::delete('/datos-postes/{id}', [DatosPostesController::class, 'destroy'])->name('datosPostes.destroy');
    
    // Rutas para gestionar usuarios
    //Route::get('/usuarios/crear', [RegisteredUserController::class, 'create'])->name('users.create'); // Formulario para crear usuarios
    //Route::post('/usuarios', [RegisteredUserController::class, 'store'])->name('users.store'); // Almacenar nuevo usuario
    
    // Ruta para el manejo de Recursos Humanos (RH)
    Route::get('/rh', [ProfileController::class, 'showRH'])->name('rh');
    
});

require __DIR__.'/auth.php';
