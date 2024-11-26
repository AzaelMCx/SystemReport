<?php

namespace App\Http\Controllers;

use App\Models\Postes;
use Illuminate\Http\Request;

class DatosPostesController extends Controller
{
    // Mostrar todos los registros de DatosPostes
    public function index()
    {
        $datosPostes = Postes::all(); // Obtener todos los registros de la tabla "datos_postes"
        return view('datosPostes', compact('datosPostes')); // Pasar los datos a la vista
    }

    // Mostrar el formulario para editar un registro
    public function edit($id)
    {
        $poste = Postes::findOrFail($id);
        return view('datosPostes.edit', compact('poste'));
    }

    // Actualizar el registro en la base de datos
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'NameCamera' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'Brand' => 'required|string|max:255',
            'Model' => 'required|string|max:255',
            'IP' => 'required|ip',
            'Gateway' => 'required|ip',
        ]);

        // Buscar el poste y actualizarlo
        $poste = Postes::findOrFail($id);
        $poste->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('datosPostes.index')->with('success', 'Actualización Exitosa');
        
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $poste = Postes::findOrFail($id);
        $poste->delete();

        return redirect()->route('datosPostes.index')->with('success', 'Datos del poste eliminados correctamente.');
    }
}
