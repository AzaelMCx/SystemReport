<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function index()
    {
        $cameras = Camera::all(); // Obtener todas las cámaras

        return view('dashboard', compact('cameras'));
    }

    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('camera.create');
    }

    // Método para almacenar la cámara en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Crear y almacenar la cámara
        Camera::create([
            'name' => $request->name,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirigir a la página principal (dashboard)
        return redirect()->route('dashboard')->with('success', 'Cámara agregada exitosamente!');
    }
}
