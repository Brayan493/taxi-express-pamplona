<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarifas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .navbar {
            background: linear-gradient(135deg, #00bcd4, #009688);
            color: white;
            padding: 15px 30px;
        }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #00bcd4;
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
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #00bcd4; color: white; }
        .precio { font-weight: bold; color: #2e7d32; }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.activa { background: #d4edda; color: #155724; }
        .badge.inactiva { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>💰 Tarifas de Destinos</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Destino</th>
                    <th>Descripción</th>
                    <th>Distancia (km)</th>
                    <th>Tarifa Base</th>
                    <th>Tarifa Nocturna</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tarifas as $tarifa)
                    <tr>
                        <td>{{ $tarifa->nombre_destino }}</td>
                        <td>{{ $tarifa->descripcion ?? 'N/A' }}</td>
                        <td>{{ $tarifa->distancia_km ? number_format($tarifa->distancia_km, 1) : 'N/A' }}</td>
                        <td class="precio">${{ number_format($tarifa->tarifa_base, 0) }}</td>
                        <td class="precio">${{ number_format($tarifa->tarifa_nocturna ?? $tarifa->tarifa_base, 0) }}</td>
                        <td>
                            <span class="badge {{ $tarifa->activo ? 'activa' : 'inactiva' }}">
                                {{ $tarifa->activo ? 'Activa' : 'Inactiva' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay tarifas registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $tarifas->links() }}
        </div>
    </div>
</body>
</html>