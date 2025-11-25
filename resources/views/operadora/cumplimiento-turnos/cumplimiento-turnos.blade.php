<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cumplimiento de Turnos - Operadora</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            font-size: 24px;
        }
        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .btn-logout {
            background: white;
            color: #9c27b0;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-logout:hover {
            background: #f0f0f0;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .content-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .content-card h2 {
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #9c27b0;
            padding-bottom: 10px;
        }
        .menu-links {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }
        .menu-links a {
            padding: 10px 20px;
            background: #9c27b0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .menu-links a.active,
        .menu-links a:hover {
            background: #7b1fa2;
        }
        /* Estilos de tabla */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .data-table th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
        }
        .data-table tr:hover {
            background-color: #f5f5f5;
        }
        .btn-detalle {
            background: #4caf50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
        .btn-detalle:hover {
            background: #388e3c;
        }
        .filter-form {
            margin-bottom: 20px;
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .filter-form label {
            font-weight: bold;
            color: #555;
        }
        .filter-form input[type="date"],
        .filter-form button {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .filter-form button {
            background: #03a9f4;
            color: white;
            cursor: pointer;
            border: none;
        }
        .filter-form button:hover {
            background: #0288d1;
        }
        /* Estilos de estado */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            text-align: center;
        }
        .status-badge.ok { background-color: #4caf50; } /* Verde */
        .status-badge.tarde { background-color: #ff9800; } /* Naranja */
        .status-badge.falta { background-color: #f44336; } /* Rojo */
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Panel de Operadora - Taxi Express Pamplona</h1>
        <div class="user-info">
            <span>Bienvenida, {{ Auth::user()->nombre ?? 'Operadora' }} {{ Auth::user()->apellido ?? 'Invitada' }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <div class="container">
        {{-- Menú de Navegación Rápida --}}
        <div class="menu-links">
            <a href="{{ route('operadora.dashboard') }}">Dashboard</a>
            <a href="{{ route('operadora.vehiculos') }}">Vehículos</a>
            <a href="{{ route('operadora.control-turnos') }}">Control de Turnos</a>
            <a href="{{ route('operadora.turnos-obligatorios') }}">Turnos Obligatorios</a>
            <a href="{{ route('operadora.cumplimiento-turnos') }}" class="active">Cumplimiento de Turnos</a>
            
        </div>
        
        <div class="content-card">
            <h2>Reporte de Cumplimiento de Turnos</h2>

            {{-- Formulario de Filtro (Ejemplo) --}}
            <form action="{{ route('operadora.cumplimiento-turnos') }}" method="GET" class="filter-form">
                <label for="fecha_filtro">Filtrar por Fecha:</label>
                <input type="date" id="fecha_filtro" name="fecha" value="{{ request('fecha', date('Y-m-d')) }}">
                <button type="submit">Aplicar Filtro</button>
            </form>

            {{-- Tabla de Cumplimiento --}}
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Conductor</th>
                        <th>Vehículo (Móvil)</th>
                        <th>Turnos Asignados</th>
                        <th>Turnos Cumplidos</th>
                        <th>Incidencias</th>
                        <th>% Cumplimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Iterar sobre los datos de cumplimiento pasados por el controlador --}}
                    {{-- $reporteCumplimiento debe ser una colección de objetos/arrays --}}
                    @forelse($reporteCumplimiento ?? [] as $reporte)
                        <tr>
                            <td>{{ $reporte['nombre_conductor'] ?? 'N/A' }}</td>
                            <td>{{ $reporte['placa'] ?? 'N/A' }} ({{ $reporte['movil'] ?? 'N/A' }})</td>
                            <td>{{ $reporte['asignados'] ?? 0 }}</td>
                            <td>{{ $reporte['cumplidos'] ?? 0 }}</td>
                            <td>{{ $reporte['incidencias'] ?? 0 }}</td>
                            <td>
                                {{-- Lógica simple para calcular porcentaje. Asumimos que $reporte tiene el valor precalculado --}}
                                @php
                                    $porcentaje = $reporte['porcentaje_cumplimiento'] ?? 0;
                                    $clase_estado = 'ok';
                                    if ($porcentaje < 80) $clase_estado = 'tarde';
                                    if ($porcentaje < 50) $clase_estado = 'falta';
                                @endphp
                                <span class="status-badge {{ $clase_estado }}">
                                    {{ $porcentaje }}%
                                </span>
                            </td>
                            <td>
                                {{-- El ID debe ser el del conductor o el del turno, dependiendo de cómo quieras ver el detalle.
                                    Usaremos el ID del conductor por ahora para ver su historial. --}}
                                <a href="{{ route('operadora.detalle-cumplimiento', ['id' => $reporte['id_conductor'] ?? 0]) }}" class="btn-detalle">Ver Detalle</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No se encontraron datos de cumplimiento para la fecha seleccionada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>