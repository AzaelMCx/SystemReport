<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DatosPostesController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Ruta para el dashboard
Route::get('/dashboard', [ReportController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('cameras', CameraController::class);
    Route::resource('reports', ReportController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/history', [ReportController::class, 'history'])->name('history');
    Route::get('/cameras/{id}/download-reports', [ReportController::class, 'downloadCameraReports'])->name('cameras.downloadReports');
    Route::post('/reports/{id}/update-status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');

    // Rutas de DatosPostes
    Route::get('/datos-postes', [DatosPostesController::class, 'index'])->name('datosPostes.index');
    Route::get('/datos-postes/{id}/edit', [DatosPostesController::class, 'edit'])->name('datosPostes.edit');
    Route::resource('datosPostes', DatosPostesController::class);
    Route::delete('/datos-postes/{id}', [DatosPostesController::class, 'destroy'])->name('datosPostes.destroy');

    // Ruta para el manejo de Recursos Humanos (RH)
    Route::get('/rh', [ProfileController::class, 'showRH'])->name('rh');

    // Ruta para refaccionamientos
    Route::get('/refaccionamiento', function () {
        return view('refaccionamiento');
    })->name('refaccionamiento');
});

require __DIR__.'/auth.php';

