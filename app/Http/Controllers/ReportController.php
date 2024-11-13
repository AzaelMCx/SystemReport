<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Camera;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Muestra la lista de reportes.
     */
    public function index()
    {
        // Traemos los reportes con la cámara asociada solo con el estado 'pendiente'
        $reports = Report::with('camera')->where('status', 'pendiente')->get();
        
        // Verificamos si existen reportes pendientes, si no, enviamos el mensaje correspondiente
        if ($reports->isEmpty()) {
            $noReportsMessage = 'No hay reportes pendientes';
        } else {
            $noReportsMessage = null;
        }

        return view('reports.index', compact('reports', 'noReportsMessage'));
    }

    /**
     * Muestra el formulario de creación de un nuevo reporte.
     */
    public function create()
    {
        // Traemos las cámaras disponibles
        $cameras = Camera::all();
        return view('reports.create', compact('cameras'));
    }

    /**
     * Almacena un nuevo reporte en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'camera_id' => 'required|exists:cameras,id',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);

        // Crear el nuevo reporte
        Report::create([
            'camera_id' => $request->camera_id,
            'description' => $request->description,
            'status' => $request->status,
            'date' => $request->date,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Reporte creado correctamente');
    }

    /**
     * Actualiza el estatus de un reporte.
     */
    public function updateStatus(Request $request, $id)
    {
        // Validar que el nuevo estado sea 'pendiente' o 'solucionado'
        $request->validate([
            'status' => 'required|in:pendiente,solucionado',
        ]);

        // Encontrar el reporte y actualizar su estatus
        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('reports.index')->with('success', 'Estatus del reporte actualizado correctamente');
    }
}