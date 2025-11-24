<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Cambio de Ruta</title>
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
        .solicitud-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.autorizada { background: #d4edda; color: #155724; }
        .badge.pendiente { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🚗 Mis Solicitudes de Cambio de Ruta</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        @forelse($solicitudes as $solicitud)
            <div class="solicitud-card">
                <h3>{{ $solicitud->tarifaDestino->nombre_destino ?? 'N/A' }}</h3>
                <p><strong>Contratante:</strong> {{ $solicitud->nombre_contratante }}</p>
                <p><strong>Origen:</strong> {{ $solicitud->direccion_origen }}</p>
                <p><strong>Destino:</strong> {{ $solicitud->direccion_destino }}</p>
                <p><strong>Fecha viaje:</strong> {{ $solicitud->fecha_viaje_programada->format('d/m/Y H:i') }}</p>
                <p><strong>Pasajeros:</strong> {{ $solicitud->numero_pasajeros }}</p>
                <p><strong>Tarifa:</strong> ${{ number_format($solicitud->tarifa_cobrada, 0) }}</p>
                <p><strong>Estado:</strong>
                    <span class="badge {{ $solicitud->autorizado_por ? 'autorizada' : 'pendiente' }}">
                        {{ $solicitud->autorizado_por ? 'Autorizada' : 'Pendiente' }}
                    </span>
                </p>
                <small>Solicitada: {{ $solicitud->fecha_solicitud->format('d/m/Y H:i') }}</small>
            </div>
        @empty
            <p>No tienes solicitudes de cambio de ruta.</p>
        @endforelse

        <div style="margin-top: 20px;">
            {{ $solicitudes->links() }}
        </div>
    </div>
</body>
</html>