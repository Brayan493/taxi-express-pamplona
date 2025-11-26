<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud cambio Ruta - TAXI EXPRESS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            min-height: 100vh;
            padding: 0;
        }

        .header {
            background: linear-gradient(135deg, #00bcd4 0%, #00acc1 100%);
            color: white;
            padding: 25px 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            font-size: 32px;
        }

        .header-title {
            font-size: 28px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #00bcd4;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 20px 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-volver:hover {
            background: #0097a7;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-volver svg {
            width: 20px;
            height: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px 40px;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #00bcd4 0%, #00acc1 100%);
            color: white;
            padding: 25px 30px;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .form-content {
            padding: 30px;
        }

        .form-section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e0e0e0;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #00bcd4;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-icon {
            width: 24px;
            height: 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .required {
            color: #f44336;
        }

        .form-input,
        .form-select,
        .form-textarea {
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #00bcd4;
            box-shadow: 0 0 0 3px rgba(0, 188, 212, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-cancelar {
            background: #e0e0e0;
            color: #666;
        }

        .btn-cancelar:hover {
            background: #d0d0d0;
        }

        .btn-enviar {
            background: linear-gradient(135deg, #00bcd4 0%, #00acc1 100%);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 188, 212, 0.3);
        }

        .btn-enviar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 188, 212, 0.4);
        }

        .btn svg {
            width: 20px;
            height: 20px;
        }

        .alert {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideIn 0.3s ease;
            z-index: 1000;
            max-width: 400px;
        }

        .alert-success {
            background: #4caf50;
        }

        .alert-error {
            background: #f44336;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* ✅ Estilos para campos con error de validación */
        .form-input.error,
        .form-select.error,
        .form-textarea.error {
            border-color: #f44336;
        }

        @media (max-width: 768px) {
            .header {
                padding: 20px 20px;
            }

            .header-title {
                font-size: 22px;
            }

            .container {
                padding: 0 20px 20px;
            }

            .form-content {
                padding: 20px;
            }

            .btn-volver {
                margin: 15px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .alert {
                max-width: 90%;
                left: 5%;
                right: 5%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <span class="header-icon">🔄</span>
            <h1 class="header-title">Solicitudes de Cambio de Ruta</h1>
        </div>
    </div>

    <a href="{{ route('conductor.dashboard') }}" class="btn-volver">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Volver al Dashboard
    </a>

    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <h2>Nueva Solicitud de Servicio</h2>
                <p>Completa el formulario para solicitar un servicio de taxi</p>
            </div>

            {{-- ✅ CAMBIO IMPORTANTE: Actualizar action para usar la ruta .store --}}
            <form action="{{ route('conductor.solicitudes-cambio-ruta') }}" method="POST" class="form-content" id="solicitudForm">
                @csrf
                
                <!-- Sección: Conductor y Vehículo -->
                <div class="form-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Información del Conductor y Vehículo
                    </h3>
                    
                   <div class="form-grid">
                    <!-- Campo oculto con el ID del conductor autenticado -->
                    <input type="hidden" name="id_conductor" value="{{ $conductor->id_conductor }}">
                    
                    <div class="form-group">
                        <label class="form-label">
                            Conductor
                        </label>
                        <input type="text" class="form-control" value="{{ $conductor->primer_nombre }} {{ $conductor->primer_apellido }}" disabled>
                        <small class="form-text text-muted">Esta solicitud se registrará a tu nombre</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            Vehículo <span class="required">*</span>
                        </label>
                        <select name="id_vehiculo" required class="form-select">
                            <option value="">Seleccionar vehículo...</option>
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id_vehiculo }}" {{ old('id_vehiculo') == $vehiculo->id_vehiculo ? 'selected' : '' }}>
                                    {{ $vehiculo->placa }} - {{ $vehiculo->marca ?? '' }} {{ $vehiculo->modelo ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                 </div>
            </div>

             <div class="form-group">
            <label class="form-label">
                Tarifa/Destino <span class="required">*</span>
            </label>
            <select name="id_tarifa_destino" required class="form-select">
                <option value="">Seleccionar tarifa...</option>
                @foreach($tarifas as $tarifa)
                    <option value="{{ $tarifa->id_tarifa }}" {{ old('id_tarifa_destino') == $tarifa->id_tarifa ? 'selected' : '' }}>
                        {{ $tarifa->nombre_destino }} - ${{ number_format($tarifa->tarifa_base, 0) }}
                    </option>
                @endforeach
            </select>
        </div>

                <!-- Sección: Información del Contratante -->
                <div class="form-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Datos del Contratante
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Nombre Completo <span class="required">*</span></label>
                            <input type="text" name="nombre_contratante" required placeholder="Nombre completo del cliente" class="form-input" value="{{ old('nombre_contratante') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Documento <span class="required">*</span></label>
                            <input type="text" name="documento_contratante" required placeholder="Número de documento" class="form-input" value="{{ old('documento_contratante') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Teléfono <span class="required">*</span></label>
                        <input type="tel" name="telefono_contratante" required placeholder="Número de contacto" class="form-input" value="{{ old('telefono_contratante') }}">
                    </div>
                </div>

                <!-- Sección: Direcciones -->
                <div class="form-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        Origen y Destino
                    </h3>
                    
                    <div class="form-group">
                        <label class="form-label">Dirección de Origen <span class="required">*</span></label>
                        <textarea name="direccion_origen" required placeholder="Dirección completa de recogida del pasajero" class="form-textarea" rows="2">{{ old('direccion_origen') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dirección de Destino <span class="required">*</span></label>
                        <textarea name="direccion_destino" required placeholder="Dirección completa de destino final" class="form-textarea" rows="2">{{ old('direccion_destino') }}</textarea>
                    </div>
                </div>

                <!-- Sección: Detalles del Servicio (OPCIONAL) -->
                <div class="form-section">
                    <h3 class="section-title">
                        <svg class="section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Detalles del Servicio (Opcional)
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Fecha y Hora Programada</label>
                            <input type="datetime-local" name="fecha_viaje_programada" class="form-input" value="{{ old('fecha_viaje_programada') }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Número de Pasajeros</label>
                            <input type="number" name="numero_pasajeros" min="1" value="{{ old('numero_pasajeros', 1) }}" class="form-input">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tarifa a Cobrar</label>
                        <input type="number" name="tarifa_cobrada" step="0.01" placeholder="0.00" class="form-input" value="{{ old('tarifa_cobrada') }}">
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='{{ route('conductor.dashboard') }}'" class="btn btn-cancelar">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-enviar">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ Mensaje de éxito --}}
    @if(session('success'))
    <div class="alert alert-success" id="successAlert">
        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- ✅ Mensajes de error --}}
    @if($errors->any())
    <div class="alert alert-error" id="errorAlert">
        <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{ $errors->first() }}
    </div>
    @endif

    <script>
        // ✅ Validación del formulario antes de enviar
        document.getElementById('solicitudForm').addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            let emptyFields = [];

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    field.style.borderColor = '#f44336';
                    const label = field.closest('.form-group').querySelector('.form-label').textContent.trim();
                    emptyFields.push(label);
                } else {
                    field.classList.remove('error');
                    field.style.borderColor = '#e0e0e0';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('⚠ Por favor complete todos los campos obligatorios:\n\n' + emptyFields.join('\n'));
                return false;
            }
        });

        // ✅ Auto-ocultar alertas después de 5 segundos
        setTimeout(function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            if (successAlert) {
                successAlert.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => successAlert.remove(), 300);
            }
            
            if (errorAlert) {
                errorAlert.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => errorAlert.remove(), 300);
            }
        }, 5000);

        // ✅ Limpiar estilo de error cuando el usuario empieza a escribir
        document.querySelectorAll('.form-input, .form-select, .form-textarea').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('error');
                this.style.borderColor = '#e0e0e0';
            });
        });
    </script>
</body>
</html>