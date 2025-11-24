<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento General</title>
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
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.preventivo { background: #d4edda; color: #155724; }
        .badge.correctivo { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🔧 Mantenimiento General</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Kilometraje Recomendado</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mantenimientos as $mant)
                    <tr>
                        <td>{{ $mant->nombre }}</td>
                        <td>{{ $mant->descripcion }}</td>
                        <td>{{ $mant->kilometraje_recomendado ? number_format($mant->kilometraje_recomendado) . ' km' : 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $mant->es_preventivo ? 'preventivo' : 'correctivo' }}">
                                {{ $mant->es_preventivo ? 'Preventivo' : 'Correctivo' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">No hay mantenimientos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $mantenimientos->links() }}
        </div>
    </div>
</body>
</html>