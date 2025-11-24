<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos</title>
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
        .vehiculo-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .vehiculo-info h3 { color: #00bcd4; margin-bottom: 10px; }
        .badge {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        .badge.activo { background: #d4edda; color: #155724; }
        .badge.inactivo { background: #f8d7da; color: #721c24; }
        .badge.mantenimiento { background: #fff3cd; color: #856404; }
        .specs { display: flex; gap: 20px; margin-top: 10px; flex-wrap: wrap; }
        .spec { background: #f5f5f5; padding: 5px 10px; border-radius: 5px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🚐 Vehículos</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        @forelse($vehiculos as $vehiculo)
            <div class="vehiculo-card">
                <div class="vehiculo-info">
                    <h3>{{ $vehiculo->placa }}</h3>
                    <p><strong>{{ $vehiculo->marca }} {{ $vehiculo->linea }}</strong> - {{ $vehiculo->modelo }}</p>
                    <p><strong>Propietario:</strong> {{ $vehiculo->propietario->razon_social ?? 'N/A' }}</p>
                    <div class="specs">
                        <span class="spec">🎨 {{ $vehiculo->color }}</span>
                        <span class="spec">👥 {{ $vehiculo->capacidad_pasajeros }} pasajeros</span>
                        <span class="spec">⛽ {{ ucfirst($vehiculo->tipo_combustible) }}</span>
                        <span class="spec">📏 {{ number_format($vehiculo->kilometraje_actual) }} km</span>
                    </div>
                </div>
                <span class="badge {{ $vehiculo->estado }}">
                    {{ ucfirst($vehiculo->estado) }}
                </span>
            </div>
        @empty
            <p>No hay vehículos registrados.</p>
        @endforelse

        <div style="margin-top: 20px;">
            {{ $vehiculos->links() }}
        </div>
    </div>
</body>
</html>