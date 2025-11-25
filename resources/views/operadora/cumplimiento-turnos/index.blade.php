<!-- resources/views/operadora/cumplimiento-turnos/index.blade.php -->

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
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .actions-bar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: #9c27b0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-primary:hover {
            background: #7b1fa2;
        }
        .btn-back {
            background: #666;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-back:hover {
            background: #555;
        }
        .filter-section {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .filter-section label {
            font-weight: bold;
            color: #333;
        }
        .filter-section input[type="date"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #f8f8f8;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            font-weight: bold;
            color: #333;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        tr:hover {
            background: #f9f9f9;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-cumplido {
            background: #d4edda;
            color: #155724;
        }
        .badge-incumplido {
            background: #f8d7da;
            color: #721c24;
        }
        .badge-programado {
            background: #fff3cd;
            color: #856404;
        }
        .badge-justificado {
            background: #d1ecf1;
            color: #0c5460;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-edit {
            background: #ffc107;
            color: #000;
        }
        .btn-edit:hover {
            background: #e0a800;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        .btn-toggle {
            background: #17a2b8;
            color: white;
        }
        .btn-toggle:hover {
            background: #138496;
        }
        .success-message {
            padding: 15px;
            background: #d4edda;
            color: #155724;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .error-message {
            padding: 15px;
            background: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .stats {
            font-size: 13px;
            color: #666;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Cumplimiento de Turnos - Taxi Express Pamplona</h1>
        <div class="user-info">
            <span>{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        <div class="actions-bar">
            <div>
                <a href="{{ route('operadora.dashboard') }}" class="btn-back">← Volver al Dashboard</a>
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('operadora.cumplimiento-turnos') }}" style="display: flex; gap: 10px; align-items: center;">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="{{ $fecha }}" onchange="this.form.submit()">
                </form>
            </div>
            <div>
                <a href="{{ route('operadora.cumplimiento-turnos.crear') }}" class="btn-primary">+ Registrar Cumplimiento</a>
            </div>
        </div>

        <div class="table-container">
            <h2 style="margin-bottom: 20px;">Turnos del {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</h2>
            
            @if($turnos->isEmpty())
                <div class="no-data">
                    <p>No hay turnos programados para esta fecha</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Móvil</th>
                            <th>Placa</th>
                            <th>Conductor</th>
                            <th>Llamados</th>
                            <th>Respondió</th>
                            <th>En Servicio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($turnos as $turno)
                            <tr>
                                <td><strong>{{ $turno->numero_interno }}</strong></td>
                                <td>{{ $turno->placa }}</td>
                                <td>{{ $turno->primer_nombre }} {{ $turno->primer_apellido }}</td>
                                <td>
                                    <div class="stats">
                                        {{ $turno->total_llamados }} llamado(s)
                                    </div>
                                </td>
                                <td>
                                    <div class="stats">
                                        {{ $turno->llamados_respondidos }}/{{ $turno->total_llamados }}
                                    </div>
                                </td>
                                <td>
                                    <div class="stats">
                                        {{ $turno->veces_en_servicio }}/{{ $turno->total_llamados }}
                                    </div>
                                </td>
                                <td>
                                    @if($turno->estado == 'cumplido')
                                        <span class="badge badge-cumplido">Cumplido</span>
                                    @elseif($turno->estado == 'incumplido')
                                        <span class="badge badge-incumplido">Incumplido</span>
                                    @elseif($turno->estado == 'justificado')
                                        <span class="badge badge-justificado">Justificado</span>
                                    @else
                                        <span class="badge badge-programado">Programado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <form action="{{ route('operadora.cumplimiento-turnos.toggle-estado', $turno->id_turno) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-toggle" title="Cambiar estado">
                                                ⇄
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>