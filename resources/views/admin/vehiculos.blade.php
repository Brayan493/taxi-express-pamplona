<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos - Administrador</title>
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
            background: linear-gradient(135deg, #ff0000, #ffaa00);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #0066cc;
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
            background: #333;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .estado {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .estado.activo {
            background: #d4edda;
            color: #155724;
        }
        .estado.inactivo {
            background: #f8d7da;
            color: #721c24;
        }
        .estado.mantenimiento {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Gestión de Vehículos</h1>
        <span>{{ Auth::user()->nombre_completo }}</span>
    </div>

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>N° Interno</th>
                    <th>Marca/Modelo</th>
                    <th>Año</th>
                    <th>Propietario</th>
                    <th>SOAT</th>
                    <th>Tecnomecánica</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vehiculos as $vehiculo)
                    <tr>
                        <td><strong>{{ $vehiculo->placa }}</strong></td>
                        <td>{{ $vehiculo->numero_interno }}</td>
                        <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                        <td>{{ $vehiculo->anio }}</td>
                        <td>{{ $vehiculo->propietario->razon_social ?? 'N/A' }}</td>
                        <td>{{ $vehiculo->fecha_soat ? $vehiculo->fecha_soat->format('d/m/Y') : 'N/A' }}</td>
                        <td>{{ $vehiculo->fecha_tecnicomecanica ? $vehiculo->fecha_tecnicomecanica->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            <span class="estado {{ str_replace(' ', '', strtolower($vehiculo->estado)) }}">
                                {{ ucfirst($vehiculo->estado) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No hay vehículos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>