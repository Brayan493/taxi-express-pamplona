<!-- resources/views/operadora/cumplimiento-turnos/crear.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cumplimiento - Operadora</title>
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
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #9c27b0;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background: #9c27b0;
            color: white;
        }
        .btn-primary:hover {
            background: #7b1fa2;
        }
        .btn-secondary {
            background: #666;
            color: white;
        }
        .btn-secondary:hover {
            background: #555;
        }
        .error-message {
            padding: 15px;
            background: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .error-list {
            list-style: none;
            margin-top: 10px;
        }
        .error-list li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Registrar Cumplimiento de Turno</h1>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="error-message">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <strong>Por favor corrija los siguientes errores:</strong>
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('operadora.cumplimiento-turnos') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="id_turno">Turno *</label>
                    <select name="id_turno" id="id_turno" required>
                        <option value="">Seleccione un turno</option>
                        @foreach($turnos as $turno)
                            <option value="{{ $turno->id_turno }}" {{ old('id_turno') == $turno->id_turno ? 'selected' : '' }}>
                                Móvil {{ $turno->numero_interno }} - {{ $turno->placa }} - {{ $turno->primer_nombre }} {{ $turno->primer_apellido }} - {{ \Carbon\Carbon::parse($turno->fecha_turno)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nombre_franja">Franja Horaria *</label>
                    <select name="nombre_franja" id="nombre_franja" required onchange="actualizarHorarios()">
                        <option value="">Seleccione una franja</option>
                        @foreach($franjas as $index => $franja)
                            <option value="{{ $franja['nombre'] }}" 
                                    data-inicio="{{ $franja['hora_inicio'] }}" 
                                    data-fin="{{ $franja['hora_fin'] }}" 
                                    data-cruza="{{ $franja['cruza_medianoche'] ? '1' : '0' }}"
                                    {{ old('nombre_franja') == $franja['nombre'] ? 'selected' : '' }}>
                                {{ $franja['nombre'] }} ({{ $franja['hora_inicio'] }} - {{ $franja['hora_fin'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="hora_inicio">Hora Inicio *</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}" required>
                </div>

                <div class="form-group">
                    <label for="hora_fin">Hora Fin *</label>
                    <input type="time" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}" required>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="cruza_medianoche" id="cruza_medianoche" value="1" {{ old('cruza_medianoche') ? 'checked' : '' }}>
                        <label for="cruza_medianoche">Cruza medianoche</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hora_llamado">Hora del Llamado *</label>
                    <input type="time" name="hora_llama
                    <div class="form-container">
    <form action="{{ route('operadora.cumplimiento-turnos') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="id_turno">Turno Obligatorio (Fecha, Móvil, Conductor)</label>
            <select name="id_turno" id="id_turno" required>
                <option value="">Seleccione un turno</option>
                @foreach($turnos as $turno)
                    <option 
                        value="{{ $turno->id_turno }}" 
                        data-fecha="{{ $turno->fecha_turno }}"
                        {{ old('id_turno') == $turno->id_turno ? 'selected' : '' }}
                    >
                        {{ \Carbon\Carbon::parse($turno->fecha_turno)->format('d/m/Y') }} - Móvil {{ $turno->numero_interno }} ({{ $turno->primer_nombre }} {{ $turno->primer_apellido }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="franja_select">Franja de Llamado</label>
            <select id="franja_select" class="form-control" onchange="actualizarFranja(this.value)">
                <option value="">Seleccione una franja predefinida</option>
                @foreach($franjas as $franja)
                    <option value="{{ $franja['nombre'] }}" 
                        data-inicio="{{ $franja['hora_inicio'] }}" 
                        data-fin="{{ $franja['hora_fin'] }}" 
                        data-cruza="{{ $franja['cruza_medianoche'] ? 1 : 0 }}"
                    >
                        {{ $franja['nombre'] }} ({{ $franja['hora_inicio'] }} a {{ $franja['hora_fin'] }})
                    </option>
                @endforeach
            </select>
        </div>
        
        <input type="hidden" name="nombre_franja" id="nombre_franja" value="{{ old('nombre_franja') }}">
        <input type="hidden" name="hora_inicio" id="hora_inicio" value="{{ old('hora_inicio') }}">
        <input type="hidden" name="hora_fin" id="hora_fin" value="{{ old('hora_fin') }}">
        <input type="hidden" name="cruza_medianoche" id="cruza_medianoche" value="{{ old('cruza_medianoche', 0) }}">


        <div class="form-group">
            <label for="hora_llamado">Hora del Llamado</label>
            <input type="time" name="hora_llamado" id="hora_llamado" required value="{{ old('hora_llamado', now()->format('H:i')) }}">
        </div>

        <div class="form-group">
            <label>Resultado del Llamado</label>
            <div class="checkbox-group">
                <input type="checkbox" name="respondio" id="respondio" value="1" {{ old('respondio') ? 'checked' : '' }}>
                <label for="respondio">¿Respondió el Conductor?</label>
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox-group">
                <input type="checkbox" name="en_servicio" id="en_servicio" value="1" {{ old('en_servicio') ? 'checked' : '' }}>
                <label for="en_servicio">¿Estaba En Servicio / Disponible?</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar Registro</button>
            <a href="{{ route('operadora.cumplimiento-turnos') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    function actualizarFranja(nombreFranja) {
        const select = document.getElementById('franja_select');
        const selectedOption = select.options[select.selectedIndex];

        if (nombreFranja) {
            document.getElementById('nombre_franja').value = selectedOption.value;
            document.getElementById('hora_inicio').value = selectedOption.dataset.inicio;
            document.getElementById('hora_fin').value = selectedOption.dataset.fin;
            document.getElementById('cruza_medianoche').value = selectedOption.dataset.cruza;
        } else {
            document.getElementById('nombre_franja').value = '';
            document.getElementById('hora_inicio').value = '';
            document.getElementById('hora_fin').value = '';
            document.getElementById('cruza_medianoche').value = 0;
        }
    }
</script>