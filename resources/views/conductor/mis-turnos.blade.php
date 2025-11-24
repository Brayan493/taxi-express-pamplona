<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Turnos - Conductor</title>
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
            background: linear-gradient(135deg, #00695c, #00bfa5);
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
            background: #00695c;
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
            background: #00695c;
            color: white;
        }
        .estado {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .estado.programado {
            background: #cce5ff;
            color: #004085;
        }
        .estado.cumplido {
            background: #d4edda;
            color: #155724;
        }
        .estado.incumplido {
            background: #f8d7da;
            color: #721c24;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }
        .pagination .active {
            background: #00695c;
            color: white;
            border-color: #00695c;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Mis Turnos</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Vehículo</th>
                    <th>Placa</th>
                    <th>N° Móvil</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($turnos as $turno)
                    <tr>
                        <td>{{ $turno->fecha_turno->format('d/m/Y') }}</td>
                        <td>{{ $turno->vehiculo->marca }} {{ $turno->vehiculo->modelo }}</td>
                        <td><strong>{{ $turno->vehiculo->placa }}</strong></td>
                        <td>{{ $turno->vehiculo->numero_interno }}</td>
                        <td>
                            <span class="estado {{ $turno->estado }}">
                                {{ ucfirst($turno->estado) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">No tienes turnos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $turnos->links() }}
        </div>
    </div>
</body>
</html>