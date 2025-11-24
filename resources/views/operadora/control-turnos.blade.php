<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Turnos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .navbar {
            background: linear-gradient(135deg, #9c27b0, #e91e63);
            color: white;
            padding: 15px 30px;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #9c27b0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #9c27b0;
            color: white;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.si {
            background: #d4edda;
            color: #155724;
        }
        .badge.no {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Control de Turnos</h1>
    </div>

    <div class="container">
        <a href="{{ route('operadora.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Conductor</th>
                    <th>Franja</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Hora Llamado</th>
                    <th>Respondió</th>
                    <th>En Servicio</th>
                </tr>
            </thead>
            <tbody>
                @forelse($controles as $control)
                    <tr>
                        <td>{{ $control->turno->vehiculo->placa }}</td>
                        <td>{{ $control->turno->conductor->primer_nombre }} {{ $control->turno->conductor->primer_apellido }}</td>
                        <td>{{ $control->nombre_franja }}</td>
                        <td>{{ $control->hora_inicio }}</td>
                        <td>{{ $control->hora_fin }}</td>
                        <td>{{ $control->hora_llamado }}</td>
                        <td>
                            <span class="badge {{ $control->respondio ? 'si' : 'no' }}">
                                {{ $control->respondio ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $control->en_servicio ? 'si' : 'no' }}">
                                {{ $control->en_servicio ? 'Sí' : 'No' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No hay controles de turno registrados hoy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>