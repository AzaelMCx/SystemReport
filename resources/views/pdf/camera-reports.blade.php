<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #002B5C;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        header img {
            max-height: 50px;
        }
        header h1 {
            margin: 5px 0;
        }
        .content {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Empresa">
        <h1>Historial de Reportes: {{ $camera->name }}</h1>
    </header>

    <div class="content">
        <h3>Datos de Cámara</h3>
        <p><strong>Nombre:</strong> {{ $camera->name }}</p>
        <p><strong>Ubicación:</strong> {{ $camera->location ?? 'No especificada' }}</p>

        <h3>Lista de reportes </h3>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($camera->reports as $report)
                    <tr>
                        <td>{{ $report->description }}</td>
                        <td>{{ $report->date }}</td>
                        <td style="color: green; font-weight: bold;">{{ ucfirst($report->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>Documento generado el {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <p>&copy; {{ date('Y') }} SESESP Tlaxcala. Todos los derechos reservados.</p>
    </footer>
</body>
</html>