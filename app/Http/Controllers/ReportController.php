<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Camera;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Muestra la lista de reportes.
     */
    public function index()
    {
        $reports = Report::with('camera')->where('status', 'pendiente')->get();
        $noReportsMessage = $reports->isEmpty() ? 'No hay reportes pendientes' : null;

        return view('reports.index', compact('reports', 'noReportsMessage'));
    }

    /**
     * Muestra el formulario de creación de un nuevo reporte.
     */
    public function create()
    {
        $cameras = Camera::all();
        return view('reports.create', compact('cameras'));
    }

    /**
     * Almacena un nuevo reporte en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'camera_id' => 'required|exists:cameras,id',
            'description' => 'required|string|max:255',
            'status' => 'required|string',
            'date' => 'required|date',
        ]);

        Report::create([
            'camera_id' => $request->camera_id,
            'description' => $request->description,
            'status' => $request->status,
            'date' => $request->date,
            'usereport' => Auth::user()->name,
        ]);

        return redirect()->route('dashboard')->with('success', 'Reporte creado correctamente');
    }

    /**
     * Muestra el panel principal con estadísticas de reportes.
     */
    public function dashboard()
    {
        $cameras = Camera::with('reports')->get();

        // Totales de reportes
        $pendingReportsCount = Report::where('status', 'Pendiente')->count();
        $refaccionamientoReportsCount = Report::where('status', 'Refaccionamiento')->count();

        return view('dashboard', compact('cameras', 'pendingReportsCount', 'refaccionamientoReportsCount'));
    }

    /**
     * Actualiza el estatus de un reporte.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pendiente,solucionado,refaccionamiento',
            'solutions' => 'nullable|string|max:255',
        ]);

        $report = Report::findOrFail($id);
        $report->status = $request->status;
        $report->solutions = $request->solutions;
        $report->save();

        return back()->with('success', 'Reporte actualizado correctamente.');

    }

    /**
     * Muestra el historial de cámaras con reportes solucionados.
     */
    public function history()
    {
        $cameras = Camera::with(['reports' => function ($query) {
            $query->solucionados();
        }])->get();

        return view('history', compact('cameras'));
    }

    /**
     * Genera y descarga un PDF con los reportes solucionados de una cámara específica.
     */
    public function downloadCameraReports($cameraId)
    {
        $camera = Camera::with(['reports' => function ($query) {
            $query->solucionados();
        }])->findOrFail($cameraId);

        if ($camera->reports->isEmpty()) {
            return redirect()->route('history')->with('error', 'Esta cámara no tiene reportes solucionados.');
        }

        $pdf = Pdf::loadView('pdf.camera-reports', compact('camera'));

        return $pdf->download('Reportes:' . $camera->name . '.pdf');
    }

    public function refaccionamiento()
    {
    // Obtener los reportes con el estatus "Refaccionamiento"
         $reports = Report::with('camera')->where('status', 'Refaccionamiento')->get();

    // Verificar si hay reportes
        $noReportsMessage = $reports->isEmpty() ? 'No hay reportes con estatus Refaccionamiento' : null;

    return view('refaccionamiento', compact('reports', 'noReportsMessage'));
   }

}
