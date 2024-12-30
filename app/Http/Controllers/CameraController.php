<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    // Método para listar cámaras en el dashboard
    public function index()
    {
        $cameras = Camera::all(); // Obtener todas las cámaras
        return view('dashboard', compact('cameras'));
    }

    // Método para listar cámaras en la vista popups
    public function showPopupList()
    {
        $cameras = Camera::all(); // Obtener todas las cámaras
        return view('popups', compact('cameras'));
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

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $camera = Camera::findOrFail($id); // Buscar la cámara por ID
        return view('camera.edit', compact('camera'));
    }

    // Método para actualizar una cámara
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Buscar y actualizar la cámara
        $camera = Camera::findOrFail($id);
        $camera->update([
            'name' => $request->name,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // Redirigir a la vista de popups
        return redirect()->route('popups.index')->with('success', 'Cámara actualizada exitosamente!');
    }

    // Método para eliminar una cámara
    public function destroy($id)
    {
        $camera = Camera::findOrFail($id); // Buscar la cámara por ID
        $camera->delete(); // Eliminar la cámara

        // Redirigir a la vista de popups
        return redirect()->route('popups.index')->with('success', 'Cámara eliminada exitosamente!');
    }
}
