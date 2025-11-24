<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propietarios - Administrador</title>
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
        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-activo {
            background: #d4edda;
            color: #155724;
        }
        .badge-inactivo {
            background: #f8d7da;
            color: #721c24;
        }
        .vehiculos-count {
            background: #007bff;
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Gestión de Propietarios</h1>
        <span>{{ Auth::user()->nombre_completo }}</span>
    </div>

    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIT</th>
                    <th>Razón Social</th>
                    <th>Representante Legal</th>
                    <th>Vehículos</th>
                    <th>Fecha Registro</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($propietarios as $propietario)
                    <tr>
                        <td>{{ $propietario->id_propietario }}</td>
                        <td><strong>{{ $propietario->nit }}</strong></td>
                        <td><strong>{{ $propietario->razon_social }}</strong></td>
                        <td>{{ $propietario->representante_legal }}</td>
                        <td style="text-align: center;">
                            <span class="vehiculos-count">{{ $propietario->vehiculos_count ?? 0 }}</span>
                        </td>
                        <td>{{ $propietario->fecha_registro ? \Carbon\Carbon::parse($propietario->fecha_registro)->format('d/m/Y') : 'N/A' }}</td>
                        <td>
                            @if($propietario->activo)
                                <span class="badge badge-activo">Activo</span>
                            @else
                                <span class="badge badge-inactivo">Inactivo</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">No hay propietarios registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>