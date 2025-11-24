@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Encabezado -->
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Administrativo</h1>
        <p class="text-muted">Resumen general del sistema - Taxi Express Pamplona</p>
    </div>

    <!-- Tarjetas de Estadísticas Principales -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Vehículos Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vehiculosActivos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Conductores Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $conductoresActivos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Turnos Hoy
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $turnosHoy }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Alertas Pendientes
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $alertasPendientes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grid de Secciones -->
    <div class="row g-3">
        <!-- Alertas Recientes -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-danger">⚠ Alertas Recientes</h6>
                    <a href="{{ route('admin.alertas.index') }}" class="btn btn-sm btn-outline-danger">Ver todas →</a>
                </div>
                <div class="card-body">
                    @forelse($alertasRecientes as $alerta)
                        <div class="alert alert-{{ $alerta->prioridad == 'critica' ? 'danger' : ($alerta->prioridad == 'alta' ? 'warning' : 'info') }} mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ str_replace('_', ' ', ucfirst($alerta->tipo_alerta)) }}</strong>
                                    <p class="mb-1 small">{{ $alerta->descripcion }}</p>
                                    <small class="text-muted">
                                        @if($alerta->vehiculo)
                                            Vehículo: {{ $alerta->vehiculo->placa }}
                                        @endif
                                        @if($alerta->conductor)
                                            | Conductor: {{ $alerta->conductor->primer_nombre }} {{ $alerta->conductor->primer_apellido }}
                                        @endif
                                        @if($alerta->fecha_vencimiento)
                                            | Vence: {{ \Carbon\Carbon::parse($alerta->fecha_vencimiento)->format('d/m/Y') }}
                                        @endif
                                    </small>
                                </div>
                                <span class="badge bg-{{ $alerta->prioridad == 'critica' ? 'danger' : ($alerta->prioridad == 'alta' ? 'warning' : 'info') }}">
                                    {{ ucfirst($alerta->prioridad) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3">✓ No hay alertas pendientes</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Solicitudes de Cambio de Ruta Pendientes -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">📝 Solicitudes de Cambio de Ruta</h6>
                    <a href="{{ route('admin.solicitudes-cambio-ruta.index') }}" class="btn btn-sm btn-outline-primary">Ver todas →</a>
                </div>
                <div class="card-body">
                    @forelse($solicitudesRecientes as $solicitud)
                        <div class="border-bottom pb-2 mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ $solicitud->conductor->primer_nombre ?? 'N/A' }} {{ $solicitud->conductor->primer_apellido ?? '' }}</strong>
                                    <div class="small">
                                        <i class="fas fa-car"></i> {{ $solicitud->vehiculo->placa ?? 'N/A' }}
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $solicitud->tarifaDestino->nombre_destino ?? 'N/A' }}
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-user"></i> Contratante: {{ $solicitud->nombre_contratante }}
                                    </div>
                                    <div class="small text-muted">
                                        <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($solicitud->fecha_viaje_programada)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                <span class="badge bg-{{ $solicitud->autorizado_por ? 'success' : 'warning' }}">
                                    {{ $solicitud->autorizado_por ? 'Autorizado' : 'Pendiente' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-3">No hay solicitudes pendientes</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Control de Turnos del Día -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-info">📋 Control de Turnos Hoy</h6>
                    <a href="{{ route('admin.control-turnos.index') }}" class="btn btn-sm btn-outline-info">Ver todos →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Vehículo</th>
                                    <th>Conductor</th>
                                    <th>Franja</th>
                                    <th>Respondió</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($controlTurnosHoy as $control)
                                    <tr>
                                        <td><strong>{{ $control->turno->vehiculo->placa ?? 'N/A' }}</strong></td>
                                        <td>{{ $control->turno->conductor->primer_nombre ?? 'N/A' }}</td>
                                        <td><small>{{ $control->nombre_franja }}</small></td>
                                        <td>
                                            <span class="badge bg-{{ $control->respondio ? 'success' : 'danger' }}">
                                                {{ $control->respondio ? 'Sí' : 'No' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $control->en_servicio ? 'success' : 'secondary' }}">
                                                {{ $control->en_servicio ? 'En servicio' : 'Fuera' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted">No hay turnos para hoy</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conductores Recientes -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-success">👥 Conductores Recientes</h6>
                    <a href="{{ route('admin.conductores.index') }}" class="btn btn-sm btn-outline-success">Ver todos →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Licencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($conductoresRecientes as $conductor)
                                    <tr>
                                        <td>{{ $conductor->primer_nombre }} {{ $conductor->primer_apellido }}</td>
                                        <td><small>{{ $conductor->tipo_documento }}: {{ $conductor->numero_documento }}</small></td>
                                        <td><small>{{ $conductor->categoria_licencia }}</small></td>
                                        <td>
                                            <span class="badge bg-{{ $conductor->estado == 'activo' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($conductor->estado) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">No hay conductores</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehículos Recientes -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">🚐 Vehículos Recientes</h6>
                    <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-sm btn-outline-primary">Ver todos →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Móvil</th>
                                    <th>Marca/Modelo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vehiculosRecientes as $vehiculo)
                                    <tr>
                                        <td><strong>{{ $vehiculo->placa }}</strong></td>
                                        <td><span class="badge bg-info">{{ $vehiculo->numero_interno }}</span></td>
                                        <td><small>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</small></td>
                                        <td>
                                            <span class="badge bg-{{ $vehiculo->estado == 'activo' ? 'success' : ($vehiculo->estado == 'en mantenimiento' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($vehiculo->estado) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">No hay vehículos</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mantenimientos Próximos -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-warning">🔧 Próximos Mantenimientos</h6>
                    <a href="{{ route('admin.mantenimiento-general.index') }}" class="btn btn-sm btn-outline-warning">Ver todos →</a>
                </div>
                <div class="card-body">
                    @forelse($mantenimientosProximos as $mantenimiento)
                        <div class="border-bottom pb-2 mb-2">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $mantenimiento->vehiculo->placa ?? 'N/A' }}</strong>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($mantenimiento->fecha_mantenimiento)->format('d/m/Y') }}</small>
                            </div>
                            <small>{{ $mantenimiento->mantenimientoGeneral->nombre ?? 'Mantenimiento general' }}</small>
                            <div class="small text-muted">
                                <i class="fas fa-tools"></i> {{ $mantenimiento->descripcion }}
                            </div>
                            @if($mantenimiento->costo)
                                <div class="small text-success">
                                    <i class="fas fa-dollar-sign"></i> ${{ number_format($mantenimiento->costo, 0) }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted text-center py-3">No hay mantenimientos próximos</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Propietarios -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-secondary">👤 Propietarios</h6>
                    <a href="{{ route('admin.propietarios.index') }}" class="btn btn-sm btn-outline-secondary">Ver todos →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Razón Social</th>
                                    <th>NIT</th>
                                    <th>Representante</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($propietariosRecientes as $propietario)
                                    <tr>
                                        <td><small>{{ $propietario->razon_social }}</small></td>
                                        <td><small>{{ $propietario->nit }}</small></td>
                                        <td><small>{{ $propietario->representante_legal }}</small></td>
                                        <td>
                                            <span class="badge bg-{{ $propietario->activo ? 'success' : 'secondary' }}">
                                                {{ $propietario->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">No hay propietarios</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarifas de Destinos -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-info">💰 Tarifas de Destinos</h6>
                    <a href="{{ route('admin.tarifas-destino.index') }}" class="btn btn-sm btn-outline-info">Ver todas →</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Destino</th>
                                    <th>Ciudad</th>
                                    <th>Tarifa</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tarifasDestino as $tarifa)
                                    <tr>
                                        <td><strong>{{ $tarifa->nombre_destino }}</strong></td>
                                        <td><small>{{ $tarifa->ciudad }}</small></td>
                                        <td><strong class="text-success">${{ number_format($tarifa->tarifa_base, 0) }}</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $tarifa->activa ? 'success' : 'secondary' }}">
                                                {{ $tarifa->activa ? 'Activa' : 'Inactiva' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-muted">No hay tarifas</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-primary { color: #4e73df !important; }
.text-success { color: #1cc88a !important; }
.text-info { color: #36b9cc !important; }
.text-warning { color: #f6c23e !important; }
.text-danger { color: #e74a3b !important; }
.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}
.table-hover tbody tr:hover {
    background-color: #f8f9fc;
}
</style>
@endsection