<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cámara - {{ $camera->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Membrete */
        .header {
            background-color: #358bfae3;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
            vertical-align: middle;
        }

        .header .company-info {
            font-size: 16px;
        }

        .container {
            padding: 20px;
            margin-top: 20px;
        }

        .camera-section {
            margin-bottom: 40px;
        }

        .camera-section h3 {
            color: #333;
            font-size: 22px;
            border-bottom: 2px solid #0073e6;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .report-card {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .report-card h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .report-card p {
            font-size: 14px;
            color: #555;
        }

        .status {
            font-weight: bold;
            color: #28a745; /* Verde para estado 'solucionado' */
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Membrete -->
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" style="width: 140px; height: auto;"alt="Logo Empresa"><br>
        Listado de Reportes: {{ $camera->name }}
        <div class="company-info">Monitoreo y seguimiento</div>
    </div>

    <!-- Contenedor Principal -->
    <div class="container">
        <div class="camera-section">
            <h3>Nombre: {{ $camera->name }}</h3>
            @foreach($camera->reports as $report)
            <div class="report-card">
                <h4>Reporte: {{ $report->description }}</h4>
                <p><strong>Fecha de reportes:</strong> {{ $report->date }}</p>
                <p><strong>Fecha de solucion:</strong> {{ $report->updated_at }}</p>
                <p><strong>Solucion:</strong> {{ $report->solutions }}</p>
                <p><strong>Estatus:</strong> <span class="status">{{ ucfirst($report->status) }}</span></p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pie de Página -->
    <div class="footer">
        <p>Documento generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <p>&copy; {{ date('Y') }} SESESP, Gobierno Del Estado de Tlaxcala.</p>
    </div>

</body>
</html>