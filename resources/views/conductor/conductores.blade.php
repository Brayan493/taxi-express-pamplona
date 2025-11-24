<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conductores</title>
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
    </style>
</head>
<body>
    <div class="navbar">
        <h1>👥 Conductores</h1>
    </div>

    <div class="container">
        <a href="{{ route('conductor.dashboard') }}" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Licencia</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($conductores as $conductor)
                    <tr>
                        <td>{{ $conductor->tipo_documento }} {{ $conductor->numero_documento }}</td>
                        <td>{{ $conductor->primer_nombre }} {{ $conductor->primer_apellido }}</td>
                        <td>{{ $conductor->celular }}</td>
                        <td>{{ $conductor->email }}</td>
                        <td>{{ $conductor->numero_licencia }}</td>
                        <td>{{ ucfirst($conductor->estado) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay conductores registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $conductores->links() }}
        </div>
    </div>
</body>
</html>