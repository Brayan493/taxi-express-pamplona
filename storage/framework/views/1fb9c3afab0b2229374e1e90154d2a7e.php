

<?php $__env->startSection('title', 'Tarifas de Destino'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">💰 Tarifas de Destino</h1>
            <p class="text-muted mb-0">Administra las tarifas y destinos disponibles</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaTarifa">
                <i class="fas fa-plus"></i> Nueva Tarifa
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
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Total Destinos</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($tarifas->total()); ?></h3>
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
                            <h6 class="text-uppercase text-muted mb-1 small">Tarifas Activas</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($tarifas->where('activa', true)->count()); ?></h3>
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
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Tarifa Promedio</h6>
                            <h3 class="mb-0 fw-bold">$<?php echo e(number_format($tarifas->avg('tarifa_base'), 0)); ?></h3>
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
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Ciudades</h6>
                            <h3 class="mb-0 fw-bold"><?php echo e($tarifas->unique('ciudad')->count()); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET" action="<?php echo e(route('admin.tarifas-destino')); ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Búsqueda</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar destino o ciudad..." value="<?php echo e(request('buscar')); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Departamento</label>
                        <select name="departamento" class="form-select">
                            <option value="">Todos</option>
                            <option value="Santander" <?php echo e(request('departamento') == 'Santander' ? 'selected' : ''); ?>>Santander</option>
                            <option value="Norte de Santander" <?php echo e(request('departamento') == 'Norte de Santander' ? 'selected' : ''); ?>>Norte de Santander</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Estado</label>
                        <select name="activa" class="form-select">
                            <option value="">Todos</option>
                            <option value="1" <?php echo e(request('activa') === '1' ? 'selected' : ''); ?>>Activas</option>
                            <option value="0" <?php echo e(request('activa') === '0' ? 'selected' : ''); ?>>Inactivas</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Tarifa Desde</label>
                        <input type="number" name="tarifa_min" class="form-control" placeholder="Min" value="<?php echo e(request('tarifa_min')); ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Tarifa Hasta</label>
                        <input type="number" name="tarifa_max" class="form-control" placeholder="Max" value="<?php echo e(request('tarifa_max')); ?>">
                    </div>
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Tarifas -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">
                <i class="fas fa-list me-2"></i>Lista de Tarifas y Destinos
            </h6>
            <span class="badge bg-primary"><?php echo e($tarifas->total()); ?> registros</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4" style="width: 60px;">ID</th>
                            <th>Destino</th>
                            <th>Ciudad</th>
                            <th>Departamento</th>
                            <th class="text-end">Tarifa Base</th>
                            <th>Vigencia</th>
                            <th class="text-center" style="width: 100px;">Estado</th>
                            <th class="text-center" style="width: 130px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tarifas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 text-muted"><?php echo e($tarifa->id_tarifa); ?></td>
                                <td>
                                    <strong><?php echo e($tarifa->nombre_destino); ?></strong>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                    <?php echo e($tarifa->ciudad); ?>

                                </td>
                                <td><?php echo e($tarifa->departamento); ?></td>
                                <td class="text-end">
                                    <strong class="text-success">$<?php echo e(number_format($tarifa->tarifa_base, 0)); ?></strong>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        <?php echo e(\Carbon\Carbon::parse($tarifa->fecha_vigencia_desde)->format('d/m/Y')); ?>

                                        <?php if($tarifa->fecha_vigencia_hasta): ?>
                                            - <?php echo e(\Carbon\Carbon::parse($tarifa->fecha_vigencia_hasta)->format('d/m/Y')); ?>

                                        <?php else: ?>
                                            - <span class="text-success">Vigente</span>
                                        <?php endif; ?>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <?php if($tarifa->activa): ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Activa
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                                            <i class="fas fa-times-circle me-1"></i>Inactiva
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#verTarifa<?php echo e($tarifa->id_tarifa); ?>" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarTarifa<?php echo e($tarifa->id_tarifa); ?>" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="<?php echo e(route('admin.tarifas-destino', $tarifa->id_tarifa)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-<?php echo e($tarifa->activa ? 'danger' : 'success'); ?>" title="<?php echo e($tarifa->activa ? 'Desactivar' : 'Activar'); ?>">
                                                <i class="fas fa-<?php echo e($tarifa->activa ? 'ban' : 'check'); ?>"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Ver Tarifa -->
                            <div class="modal fade" id="verTarifa<?php echo e($tarifa->id_tarifa); ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-gradient-info text-white">
                                            <h5 class="modal-title">
                                                <i class="fas fa-tags me-2"></i>Detalle de Tarifa #<?php echo e($tarifa->id_tarifa); ?>

                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <!-- Estado -->
                                            <div class="alert <?php echo e($tarifa->activa ? 'alert-success' : 'alert-secondary'); ?> mb-4">
                                                <strong>Estado:</strong>
                                                <?php if($tarifa->activa): ?>
                                                    <span class="badge bg-success ms-2">Tarifa Activa</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary ms-2">Tarifa Inactiva</span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Info Principal -->
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-12">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Nombre del Destino</label>
                                                        <p class="mb-0 fw-bold fs-4"><?php echo e($tarifa->nombre_destino); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Ciudad</label>
                                                        <p class="mb-0 fw-semibold">
                                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                                            <?php echo e($tarifa->ciudad); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Departamento</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e($tarifa->departamento); ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Información Tarifaria -->
                                            <h6 class="text-primary mb-3"><i class="fas fa-dollar-sign me-2"></i>Información Tarifaria</h6>
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-12">
                                                    <div class="info-item text-center">
                                                        <label class="text-muted small text-uppercase">Tarifa Base</label>
                                                        <p class="mb-0 fw-bold text-success" style="font-size: 2rem;">$<?php echo e(number_format($tarifa->tarifa_base, 0)); ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Vigencia -->
                                            <h6 class="text-primary mb-3"><i class="fas fa-calendar-check me-2"></i>Vigencia</h6>
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Fecha Inicio</label>
                                                        <p class="mb-0 fw-semibold"><?php echo e(\Carbon\Carbon::parse($tarifa->fecha_vigencia_desde)->format('d/m/Y')); ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="text-muted small text-uppercase">Fecha Fin</label>
                                                        <p class="mb-0 fw-semibold">
                                                            <?php if($tarifa->fecha_vigencia_hasta): ?>
                                                                <?php echo e(\Carbon\Carbon::parse($tarifa->fecha_vigencia_hasta)->format('d/m/Y')); ?>

                                                            <?php else: ?>
                                                                <span class="text-success">Sin fecha límite (Vigente)</span>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i>Cerrar
                                            </button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarTarifa<?php echo e($tarifa->id_tarifa); ?>">
                                                <i class="fas fa-edit me-1"></i>Editar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Editar Tarifa -->
                            <div class="modal fade" id="editarTarifa<?php echo e($tarifa->id_tarifa); ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <form action="<?php echo e(route('admin.tarifas-destino', $tarifa->id_tarifa)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-edit me-2"></i>Editar Tarifa
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Nombre del Destino <span class="text-danger">*</span></label>
                                                    <input type="text" name="nombre_destino" class="form-control" value="<?php echo e($tarifa->nombre_destino); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Ciudad <span class="text-danger">*</span></label>
                                                    <input type="text" name="ciudad" class="form-control" value="<?php echo e($tarifa->ciudad); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Departamento <span class="text-danger">*</span></label>
                                                    <input type="text" name="departamento" class="form-control" value="<?php echo e($tarifa->departamento); ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Tarifa Base <span class="text-danger">*</span></label>
                                                    <input type="number" name="tarifa_base" class="form-control" value="<?php echo e($tarifa->tarifa_base); ?>" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-semibold">Fecha Inicio Vigencia <span class="text-danger">*</span></label>
                                                        <input type="date" name="fecha_vigencia_desde" class="form-control" value="<?php echo e($tarifa->fecha_vigencia_desde); ?>" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label fw-semibold">Fecha Fin Vigencia</label>
                                                        <input type="date" name="fecha_vigencia_hasta" class="form-control" value="<?php echo e($tarifa->fecha_vigencia_hasta); ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-0">
                                                    <label class="form-label fw-semibold">Estado</label>
                                                    <select name="activa" class="form-select">
                                                        <option value="1" <?php echo e($tarifa->activa ? 'selected' : ''); ?>>Activa</option>
                                                        <option value="0" <?php echo e(!$tarifa->activa ? 'selected' : ''); ?>>Inactiva</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save me-1"></i>Actualizar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No se encontraron tarifas</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <?php if($tarifas->hasPages()): ?>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-center">
                <?php echo e($tarifas->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Nueva Tarifa -->
<div class="modal fade" id="modalNuevaTarifa" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?php echo e(route('admin.tarifas-destino')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>Nueva Tarifa de Destino
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre del Destino <span class="text-danger">*</span></label>
                        <input type="text" name="nombre_destino" class="form-control" placeholder="Ej: San Gil Centro" required>
                        <small class="text-muted">Nombre descriptivo del destino</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ciudad <span class="text-danger">*</span></label>
                        <input type="text" name="ciudad" class="form-control" placeholder="Ej: San Gil" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Departamento <span class="text-danger">*</span></label>
                        <input type="text" name="departamento" class="form-control" placeholder="Ej: Santander" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tarifa Base <span class="text-danger">*</span></label>
                        <input type="number" name="tarifa_base" class="form-control" placeholder="Ej: 450000" required>
                        <small class="text-muted">Tarifa en pesos colombianos</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Fecha Inicio Vigencia <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_vigencia_desde" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-0">
                            <label class="form-label fw-semibold">Fecha Fin Vigencia</label>
                            <input type="date" name="fecha_vigencia_hasta" class="form-control">
                            <small class="text-muted">Opcional</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
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
.bg-secondary-subtle {
    background-color: #e2e3e5 !important;
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views/admin/tarifas-destino.blade.php ENDPATH**/ ?>