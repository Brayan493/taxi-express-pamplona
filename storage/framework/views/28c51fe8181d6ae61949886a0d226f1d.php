

<?php $__env->startSection('title', 'Solicitudes de Cambio de Ruta'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">🚗 Solicitudes de Cambio de Ruta</h1>
            <p class="text-muted mb-0">Gestiona las solicitudes de cambio de ruta de los conductores</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaSolicitud">
                <i class="fas fa-plus"></i> Nueva Solicitud
            </button>
        </div>
    </div>

    <!-- Mensajes de éxito/error -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Estadísticas -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card stat-card stat-primary shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Total Solicitudes</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($solicitudes->total()); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-warning shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Pendientes</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($solicitudes->where('autorizado_por', null)->count()); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-success shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Aprobadas</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($solicitudes->whereNotNull('autorizado_por')->count()); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card stat-card stat-info shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Tarifa Total</h6>
                            <h3 class="mb-0 fw-bold">$<?php echo e(number_format($solicitudes->sum('tarifa_cobrada'), 0)); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET" action="<?php echo e(route('admin.solicitudes-cambio-ruta')); ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small text-muted mb-1">Búsqueda</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por conductor o contratante..." value="<?php echo e(request('buscar')); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="pendiente" <?php echo e(request('estado') == 'pendiente' ? 'selected' : ''); ?>>Pendientes</option>
                            <option value="aprobado" <?php echo e(request('estado') == 'aprobado' ? 'selected' : ''); ?>>Aprobadas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Fecha Desde</label>
                        <input type="date" name="fecha_desde" class="form-control" value="<?php echo e(request('fecha_desde')); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Fecha Hasta</label>
                        <input type="date" name="fecha_hasta" class="form-control" value="<?php echo e(request('fecha_hasta')); ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 me-2">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Solicitudes -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">
                <i class="fas fa-list me-2"></i>Lista de Solicitudes
            </h6>
            <span class="badge bg-primary"><?php echo e($solicitudes->total()); ?> registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4" style="width: 60px;">ID</th>
                            <th>Fecha Solicitud</th>
                            <th>Conductor</th>
                            <th>Vehículo</th>
                            <th>Destino</th>
                            <th>Contratante</th>
                            <th class="text-end">Tarifa</th>
                            <th class="text-center" style="width: 100px;">Estado</th>
                            <th class="text-center" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 text-muted"><?php echo e($solicitud->id_solicitud); ?></td>
                                <td>
                                    <strong><?php echo e(\Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y')); ?></strong><br>
                                    <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('H:i A')); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo e($solicitud->conductor->primer_nombre); ?> <?php echo e($solicitud->conductor->primer_apellido); ?></strong><br>
                                    <small class="text-muted"><?php echo e($solicitud->conductor->tipo_documento); ?> <?php echo e($solicitud->conductor->numero_documento); ?></small>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded"><?php echo e($solicitud->vehiculo->placa); ?></code><br>
                                    <small class="text-muted"><?php echo e($solicitud->vehiculo->marca); ?> <?php echo e($solicitud->vehiculo->modelo); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo e($solicitud->tarifaDestino->nombre_destino); ?></strong><br>
                                    <small class="text-muted"><?php echo e($solicitud->tarifaDestino->ciudad); ?></small>
                                </td>
                                <td>
                                    <strong><?php echo e($solicitud->nombre_contratante); ?></strong><br>
                                    <small class="text-muted"><?php echo e($solicitud->telefono_contratante); ?></small>
                                </td>
                                <td class="text-end">
                                    <strong class="text-success">$<?php echo e(number_format($solicitud->tarifa_cobrada, 0)); ?></strong>
                                </td>
                                <td class="text-center">
                                    <?php if($solicitud->autorizado_por): ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Aprobada
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>Pendiente
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#verSolicitud<?php echo e($solicitud->id_solicitud); ?>" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if(!$solicitud->autorizado_por): ?>
                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#aprobarSolicitud<?php echo e($solicitud->id_solicitud); ?>" title="Aprobar">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Ver Solicitud -->
                            <div class="modal fade" id="verSolicitud<?php echo e($solicitud->id_solicitud); ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-gradient-info text-white">
                                            <h5 class="modal-title">
                                                <i class="fas fa-route me-2"></i>Detalle de Solicitud #<?php echo e($solicitud->id_solicitud); ?>

                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <!-- Estado -->
                                            <div class="alert <?php echo e($solicitud->autorizado_por ? 'alert-success' : 'alert-warning'); ?> mb-4">
                                                <strong>Estado:</strong>
                                                <?php if($solicitud->autorizado_por): ?>
                                                    <span class="badge bg-success ms-2">Aprobada</span>
                                                    <?php if($solicitud->autorizador): ?>
                                                        <br><small>Autorizado por: <?php echo e($solicitud->autorizador->nombre); ?> <?php echo e($solicitud->autorizador->apellido); ?></small>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="badge bg-warning ms-2">Pendiente de Aprobación</span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Info Principal -->
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Fecha Solicitud</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e(\Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y H:i A')); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Fecha Viaje Programada</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e(\Carbon\Carbon::parse($solicitud->fecha_viaje_programada)->format('d/m/Y H:i A')); ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Conductor y Vehículo -->
                                            <h6 class="text-primary mb-3"><i class="fas fa-user-tie me-2"></i>Conductor y Vehículo</h6>
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Conductor</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e($solicitud->conductor->primer_nombre); ?> <?php echo e($solicitud->conductor->primer_apellido); ?></p>
                                                        <small class="text-muted"><?php echo e($solicitud->conductor->tipo_documento); ?> <?php echo e($solicitud->conductor->numero_documento); ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Vehículo</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e($solicitud->vehiculo->placa); ?></p>
                                                        <small class="text-muted"><?php echo e($solicitud->vehiculo->marca); ?> <?php echo e($solicitud->vehiculo->modelo); ?> <?php echo e($solicitud->vehiculo->anio); ?></small>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Destino e Info de Viaje -->
                                            <h6 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Destino e Información del Viaje</h6>
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Destino</label>
                                                        <p class="mb-0 fw-bold fs-5"><?php echo e($solicitud->tarifaDestino->nombre_destino); ?></p>
                                                        <small class="text-muted"><?php echo e($solicitud->tarifaDestino->ciudad); ?>, <?php echo e($solicitud->tarifaDestino->departamento); ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Pasajeros</label>
                                                        <p class="mb-0 fw-semibold fs-5"><?php echo e($solicitud->numero_pasajeros); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Tarifa</label>
                                                        <p class="mb-0 fw-bold fs-5 text-success">$<?php echo e(number_format($solicitud->tarifa_cobrada, 0)); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Origen</label>
                                                        <p class="mb-0"><?php echo e($solicitud->direccion_origen); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Destino Final</label>
                                                        <p class="mb-0"><?php echo e($solicitud->direccion_destino); ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Contratante -->
                                            <h6 class="text-primary mb-3"><i class="fas fa-user me-2"></i>Información del Contratante</h6>
                                            <div class="row g-4">
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Nombre</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e($solicitud->nombre_contratante); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Documento</label>
                                                        <p class="mb-0"><?php echo e($solicitud->documento_contratante); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Teléfono</label>
                                                        <p class="mb-0"><?php echo e($solicitud->telefono_contratante); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i>Cerrar
                                            </button>
                                            <?php if(!$solicitud->autorizado_por): ?>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#aprobarSolicitud<?php echo e($solicitud->id_solicitud); ?>">
                                                    <i class="fas fa-check me-1"></i>Aprobar Solicitud
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Aprobar Solicitud -->
                            <?php if(!$solicitud->autorizado_por): ?>
                            <div class="modal fade" id="aprobarSolicitud<?php echo e($solicitud->id_solicitud); ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <form action="<?php echo e(route('admin.solicitudes.aprobar', $solicitud->id_solicitud)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-check-circle me-2"></i>Aprobar Solicitud
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <p>¿Está seguro de aprobar esta solicitud de cambio de ruta?</p>
                                                <div class="alert alert-info">
                                                    <strong>Solicitud:</strong> #<?php echo e($solicitud->id_solicitud); ?><br>
                                                    <strong>Conductor:</strong> <?php echo e($solicitud->conductor->primer_nombre); ?> <?php echo e($solicitud->conductor->primer_apellido); ?><br>
                                                    <strong>Destino:</strong> <?php echo e($solicitud->tarifaDestino->nombre_destino); ?>

                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check me-1"></i>Confirmar Aprobación
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No se encontraron solicitudes</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <?php if($solicitudes->hasPages()): ?>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-center">
                <?php echo e($solicitudes->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
/* Tarjetas de estadísticas */
.stat-card {
    border: none;
    border-radius: 10px;
    transition: transform 0.2s ease;
}
.stat-card:hover {
    transform: translateY(-3px);
}
.stat-primary { border-left: 4px solid #0d6efd !important; }
.stat-success { border-left: 4px solid #198754 !important; }
.stat-info { border-left: 4px solid #0dcaf0 !important; }
.stat-warning { border-left: 4px solid #ffc107 !important; }

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
}

/* Tabla */
.table > thead {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
.table > thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
    padding: 1rem 0.75rem;
}
.table > tbody > tr {
    transition: background-color 0.15s ease;
}
.table > tbody > tr:hover {
    background-color: #f8f9fc;
}
.table > tbody > tr > td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

/* Badges de estado mejorados */
.bg-success-subtle {
    background-color: #d1e7dd !important;
}
.bg-warning-subtle {
    background-color: #fff3cd !important;
}

/* Botones de acción */
.btn-group .btn {
    padding: 0.4rem 0.6rem;
    border-radius: 5px !important;
    margin: 0 2px;
}

/* Modal headers con gradiente */
.bg-gradient-info {
    background: linear-gradient(135deg, #0dcaf0 0%, #0aa2c0 100%);
}

/* Info items en modal */
.info-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    height: 100%;
}
.info-item label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    margin-bottom: 0.25rem;
    display: block;
}

/* Formularios */
.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

/* Cards */
.card {
    border: none;
    border-radius: 10px;
}
.card-header {
    border-bottom: 1px solid #eee;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\admin\solicitudes-cambio-ruta.blade.php ENDPATH**/ ?>