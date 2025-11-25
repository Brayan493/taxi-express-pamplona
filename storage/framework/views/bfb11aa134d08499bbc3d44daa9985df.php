

<?php $__env->startSection('title', 'Mantenimiento General'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-4">
    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">🔧 Mantenimiento General</h1>
            <p class="text-muted mb-0">Gestiona y programa los mantenimientos de tu flota</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoMantenimiento">
                <i class="fas fa-plus"></i> Programar Mantenimiento
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
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">Total Programados</h6>
                            <h3 class="mb-0 fw-bold">45</h3>
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
                            <h3 class="mb-0 fw-bold">12</h3>
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
                            <i class="fas fa-wrench"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="text-uppercase text-muted mb-1 small">En Proceso</h6>
                            <h3 class="mb-0 fw-bold">8</h3>
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
                            <h6 class="text-uppercase text-muted mb-1 small">Completados Mes</h6>
                            <h3 class="mb-0 fw-bold">25</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="">Todos</option>
                            <option value="preventivo">Preventivo</option>
                            <option value="correctivo">Correctivo</option>
                            <option value="predictivo">Predictivo</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Estado</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="programado">Programado</option>
                            <option value="proceso">En Proceso</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Prioridad</label>
                        <select name="prioridad" class="form-select">
                            <option value="">Todas</option>
                            <option value="alta">Alta</option>
                            <option value="media">Media</option>
                            <option value="baja">Baja</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small text-muted mb-1">Fecha Desde</label>
                        <input type="date" name="fecha_desde" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted mb-1">Búsqueda</label>
                        <input type="text" name="buscar" class="form-control" placeholder="Placa, vehículo...">
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

    <!-- Tabs de navegación -->
    <ul class="nav nav-tabs nav-tabs-custom mb-3" id="mantenimientoTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="todos-tab" data-bs-toggle="tab" data-bs-target="#todos" type="button">
                <i class="fas fa-list me-2"></i>Todos <span class="badge bg-primary ms-2">45</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes" type="button">
                <i class="fas fa-clock me-2"></i>Pendientes <span class="badge bg-warning ms-2">12</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="proceso-tab" data-bs-toggle="tab" data-bs-target="#proceso" type="button">
                <i class="fas fa-wrench me-2"></i>En Proceso <span class="badge bg-info ms-2">8</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="completados-tab" data-bs-toggle="tab" data-bs-target="#completados" type="button">
                <i class="fas fa-check-circle me-2"></i>Completados <span class="badge bg-success ms-2">25</span>
            </button>
        </li>
    </ul>

    <!-- Tabla de Mantenimientos -->
    <div class="tab-content" id="mantenimientoTabsContent">
        <div class="tab-pane fade show active" id="todos" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-tools me-2"></i>Lista de Mantenimientos
                    </h6>
                    <span class="badge bg-primary">45 registros</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4">Vehículo</th>
                                    <th>Tipo</th>
                                    <th>Descripción</th>
                                    <th>Fecha Programada</th>
                                    <th class="text-center">Prioridad</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-end">Costo Est.</th>
                                    <th class="text-center" style="width: 150px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4">
                                        <div>
                                            <strong class="d-block">ABC-123</strong>
                                            <small class="text-muted">
                                                <i class="fas fa-truck me-1"></i>Chevrolet NPR
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info px-3 py-2">
                                            <i class="fas fa-tools me-1"></i>Preventivo
                                        </span>
                                    </td>
                                    <td>Cambio de aceite y filtros</td>
                                    <td>
                                        <small>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            25/11/2024
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Media
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>Programado
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success">$250,000</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalVerMantenimiento1" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditarMantenimiento1" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success" title="Iniciar">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4">
                                        <div>
                                            <strong class="d-block">XYZ-789</strong>
                                            <small class="text-muted">
                                                <i class="fas fa-truck me-1"></i>Ford Cargo
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>Correctivo
                                        </span>
                                    </td>
                                    <td>Reparación sistema de frenos</td>
                                    <td>
                                        <small>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            22/11/2024
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2">
                                            <i class="fas fa-exclamation-circle me-1"></i>Alta
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info-subtle text-info px-3 py-2">
                                            <i class="fas fa-wrench me-1"></i>En Proceso
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success">$800,000</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalVerMantenimiento2" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditarMantenimiento2" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary" title="Completar">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4">
                                        <div>
                                            <strong class="d-block">DEF-456</strong>
                                            <small class="text-muted">
                                                <i class="fas fa-truck me-1"></i>Isuzu NQR
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info-subtle text-info px-3 py-2">
                                            <i class="fas fa-tools me-1"></i>Preventivo
                                        </span>
                                    </td>
                                    <td>Inspección general 10,000 km</td>
                                    <td>
                                        <small>
                                            <i class="fas fa-calendar me-1 text-primary"></i>
                                            20/11/2024
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success px-3 py-2">
                                            <i class="fas fa-check me-1"></i>Baja
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success-subtle text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Completado
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success">$350,000</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalVerMantenimiento3" title="Ver detalles">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" title="Descargar PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginación -->
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-center">
                        <nav>
                            <ul class="pagination mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Mantenimiento -->
<div class="modal fade" id="modalNuevoMantenimiento" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>Programar Mantenimiento
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Vehículo <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="1" selected>ABC-123 - Chevrolet NPR</option>
                                <option value="2">XYZ-789 - Ford Cargo</option>
                                <option value="3">DEF-456 - Isuzu NQR</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tipo de Mantenimiento <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="preventivo" selected>Preventivo</option>
                                <option value="correctivo">Correctivo</option>
                                <option value="predictivo">Predictivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Fecha Programada <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" value="2024-11-25" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Prioridad <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="alta">Alta</option>
                                <option value="media" selected>Media</option>
                                <option value="baja">Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" required>Cambio de aceite y filtros. Incluye revisión de niveles de líquidos y inspección visual general del motor.</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kilometraje Actual</label>
                            <input type="number" class="form-control" value="45000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Costo Estimado</label>
                            <input type="number" class="form-control" value="250000">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Taller/Proveedor</label>
                        <input type="text" class="form-control" value="Taller Mecánico El Experto">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Repuestos/Servicios Requeridos</label>
                        <textarea class="form-control" rows="3">Aceite sintético 15W-40 (5 galones)
Filtro de aceite
Filtro de aire
Filtro de combustible</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Responsable</label>
                        <input type="text" class="form-control" value="Carlos Méndez - Jefe de Mantenimiento">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Observaciones</label>
                        <textarea class="form-control" rows="2">Verificar estado de las bandas durante la inspección.</textarea>
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

<!-- Modales adicionales para los otros registros pueden seguir el mismo patrón -->

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

/* Badges mejorados */
.bg-success-subtle {
    background-color: #d1e7dd !important;
}
.bg-secondary-subtle {
    background-color: #e2e3e5 !important;
}
.bg-info-subtle {
    background-color: #cff4fc !important;
}
.bg-warning-subtle {
    background-color: #fff3cd !important;
}
.bg-danger-subtle {
    background-color: #f8d7da !important;
}

/* Botones de acción */
.btn-group .btn {
    padding: 0.4rem 0.6rem;
    border-radius: 5px !important;
    margin: 0 2px;
}

/* Tabs personalizados */
.nav-tabs-custom {
    border-bottom: 2px solid #dee2e6;
}
.nav-tabs-custom .nav-link {
    border: none;
    color: #6c757d;
    font-weight: 500;
    padding: 0.75rem 1.25rem;
    transition: all 0.3s ease;
}
.nav-tabs-custom .nav-link:hover {
    color: #0d6efd;
    background-color: #f8f9fa;
}
.nav-tabs-custom .nav-link.active {
    color: #0d6efd;
    background-color: transparent;
    border-bottom: 3px solid #0d6efd;
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
    border-radius: 10px 10px 0 0 !important;
}
.card-footer {
    border-top: 1px solid #eee;
}

/* Paginación */
.pagination .page-link {
    border-radius: 5px;
    margin: 0 3px;
    border: 1px solid #dee2e6;
    color: #0d6efd;
}
.pagination .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>
@endsectioncol-md-6 mb-3">
                            <label class="form-label fw-semibold">Vehículo <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Seleccionar vehículo...</option>
                                <option value="1">ABC-123 - Chevrolet NPR</option>
                                <option value="2">XYZ-789 - Ford Cargo</option>
                                <option value="3">DEF-456 - Isuzu NQR</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tipo de Mantenimiento <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Seleccionar tipo...</option>
                                <option value="preventivo">Preventivo</option>
                                <option value="correctivo">Correctivo</option>
                                <option value="predictivo">Predictivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Fecha Programada <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Prioridad <span class="text-danger">*</span></label>
                            <select class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="alta">Alta</option>
                                <option value="media">Media</option>
                                <option value="baja">Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Descripción <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" placeholder="Detalle del mantenimiento a realizar" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kilometraje Actual</label>
                            <input type="number" class="form-control" placeholder="Ej: 45000">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Costo Estimado</label>
                            <input type="number" class="form-control" placeholder="Ej: 250000">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Taller/Proveedor</label>
                        <input type="text" class="form-control" placeholder="Nombre del taller">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Repuestos/Servicios Requeridos</label>
                        <textarea class="form-control" rows="2" placeholder="Lista de repuestos o servicios necesarios"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Programar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Mantenimiento #1 -->
<div class="modal fade" id="modalVerMantenimiento1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-tools me-2"></i>Detalle de Mantenimiento - ABC-123
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Estado -->
                <div class="alert alert-warning mb-4">
                    <strong>Estado:</strong>
                    <span class="badge bg-warning ms-2">Programado</span>
                    <span class="badge bg-warning ms-2">Prioridad Media</span>
                </div>

                <!-- Info Principal -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Vehículo</label>
                            <p class="mb-0 fw-bold fs-5">ABC-123</p>
                            <p class="mb-0 text-muted">Chevrolet NPR 2020</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Tipo de Mantenimiento</label>
                            <p class="mb-0 fw-semibold">
                                <span class="badge bg-info px-3 py-2">Preventivo</span>
                            </p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Información de Programación -->
                <h6 class="text-primary mb-3"><i class="fas fa-calendar-alt me-2"></i>Programación</h6>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Fecha Programada</label>
                            <p class="mb-0 fw-semibold">25 de Noviembre, 2024</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Kilometraje</label>
                            <p class="mb-0 fw-semibold">45,000 km</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Descripción -->
                <h6 class="text-primary mb-3"><i class="fas fa-clipboard-list me-2"></i>Descripción</h6>
                <div class="info-item mb-4">
                    <p class="mb-0">Cambio de aceite y filtros. Incluye revisión de niveles de líquidos y inspección visual general del motor.</p>
                </div>

                <hr class="my-4">

                <!-- Información Financiera -->
                <h6 class="text-primary mb-3"><i class="fas fa-dollar-sign me-2"></i>Información Financiera y Proveedor</h6>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Costo Estimado</label>
                            <p class="mb-0 fw-bold text-success" style="font-size: 1.5rem;">$250,000</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Taller/Proveedor</label>
                            <p class="mb-0 fw-semibold">Taller Mecánico El Experto</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Repuestos/Servicios -->
                <h6 class="text-primary mb-3"><i class="fas fa-cogs me-2"></i>Repuestos y Servicios</h6>
                <div class="info-item mb-4">
                    <ul class="mb-0">
                        <li>Aceite sintético 15W-40 (5 galones)</li>
                        <li>Filtro de aceite</li>
                        <li>Filtro de aire</li>
                        <li>Filtro de combustible</li>
                    </ul>
                </div>

                <hr class="my-4">

                <!-- Información Adicional -->
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Responsable</label>
                            <p class="mb-0 fw-semibold">Carlos Méndez - Jefe de Mantenimiento</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-item">
                            <label class="text-muted small text-uppercase">Observaciones</label>
                            <p class="mb-0">Verificar estado de las bandas durante la inspección.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cerrar
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditarMantenimiento1">
                    <i class="fas fa-edit me-1"></i>Editar
                </button>
                <button type="button" class="btn btn-success">
                    <i class="fas fa-play me-1"></i>Iniciar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Mantenimiento #1 -->
<div class="modal fade" id="modalEditarMantenimiento1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form>
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Editar Mantenimiento - ABC-123
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\admin\mantenimiento-general.blade.php ENDPATH**/ ?>