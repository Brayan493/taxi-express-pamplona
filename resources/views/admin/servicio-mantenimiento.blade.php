@extends('layouts.app')

@section('title', 'Historial de Servicio y Mantenimiento')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Servicio y Mantenimiento</li>
        </ol>
    </nav>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-clipboard-list me-2"></i>Historial de Servicio y Mantenimiento</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistrarServicio">
            <i class="fas fa-plus me-2"></i>Registrar Servicio
        </button>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Servicios Este Mes</h6>
                            <h3 class="mb-0">34</h3>
                        </div>
                        <div class="fs-1 text-primary">
                            <i class="fas fa-wrench"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Preventivos</h6>
                            <h3 class="mb-0">22</h3>
                        </div>
                        <div class="fs-1 text-success">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Correctivos</h6>
                            <h3 class="mb-0">12</h3>
                        </div>
                        <div class="fs-1 text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Costo Total Mes</h6>
                            <h3 class="mb-0">$8.5M</h3>
                        </div>
                        <div class="fs-1 text-warning">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">Vehículo</label>
                    <select class="form-select">
                        <option value="">Todos</option>
                        <option value="1">ABC-123</option>
                        <option value="2">XYZ-789</option>
                        <option value="3">DEF-456</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tipo</label>
                    <select class="form-select">
                        <option value="">Todos</option>
                        <option value="preventivo">Preventivo</option>
                        <option value="correctivo">Correctivo</option>
                        <option value="predictivo">Predictivo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Categoría</label>
                    <select class="form-select">
                        <option value="">Todas</option>
                        <option value="motor">Motor</option>
                        <option value="frenos">Frenos</option>
                        <option value="suspension">Suspensión</option>
                        <option value="electrico">Eléctrico</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Fecha Desde</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Fecha Hasta</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Buscar</label>
                    <input type="text" class="form-control" placeholder="Buscar...">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Servicios -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Vehículo</th>
                            <th>Tipo</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Kilometraje</th>
                            <th>Taller</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20/11/2024</td>
                            <td>
                                <strong>ABC-123</strong><br>
                                <small class="text-muted">Chevrolet NPR</small>
                            </td>
                            <td><span class="badge bg-success">Preventivo</span></td>
                            <td><span class="badge bg-secondary">Motor</span></td>
                            <td>Cambio de aceite y filtros</td>
                            <td>45,230 km</td>
                            <td>Taller El Experto</td>
                            <td class="text-end">$250,000</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalVerServicio">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>18/11/2024</td>
                            <td>
                                <strong>XYZ-789</strong><br>
                                <small class="text-muted">Ford Cargo</small>
                            </td>
                            <td><span class="badge bg-danger">Correctivo</span></td>
                            <td><span class="badge bg-secondary">Frenos</span></td>
                            <td>Cambio de pastillas de freno traseras</td>
                            <td>62,450 km</td>
                            <td>Frenos Santander</td>
                            <td class="text-end">$420,000</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalVerServicio">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>15/11/2024</td>
                            <td>
                                <strong>DEF-456</strong><br>
                                <small class="text-muted">Isuzu NQR</small>
                            </td>
                            <td><span class="badge bg-success">Preventivo</span></td>
                            <td><span class="badge bg-secondary">Eléctrico</span></td>
                            <td>Revisión sistema eléctrico y batería</td>
                            <td>38,120 km</td>
                            <td>AutoElectro</td>
                            <td class="text-end">$180,000</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalVerServicio">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>10/11/2024</td>
                            <td>
                                <strong>ABC-123</strong><br>
                                <small class="text-muted">Chevrolet NPR</small>
                            </td>
                            <td><span class="badge bg-danger">Correctivo</span></td>
                            <td><span class="badge bg-secondary">Suspensión</span></td>
                            <td>Reemplazo de amortiguadores delanteros</td>
                            <td>44,890 km</td>
                            <td>Suspensiones JM</td>
                            <td class="text-end">$650,000</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalVerServicio">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <nav>
                <ul class="pagination justify-content-center mb-0">
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

    <!-- Estadísticas Adicionales -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Costos por Categoría (Mes Actual)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Motor</span>
                            <strong>$2,850,000</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary" style="width: 35%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Frenos</span>
                            <strong>$2,120,000</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 26%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Suspensión</span>
                            <strong>$1,730,000</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 21%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Eléctrico</span>
                            <strong>$980,000</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 12%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Otros</span>
                            <strong>$820,000</strong>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-secondary" style="width: 10%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Top 5 Vehículos con Más Mantenimientos</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>ABC-123</strong> - Chevrolet NPR<br>
                                <small class="text-muted">8 servicios este mes</small>
                            </div>
                            <span class="badge bg-danger rounded-pill">$1.8M</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>XYZ-789</strong> - Ford Cargo<br>
                                <small class="text-muted">6 servicios este mes</small>
                            </div>
                            <span class="badge bg-warning rounded-pill">$1.4M</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>DEF-456</strong> - Isuzu NQR<br>
                                <small class="text-muted">5 servicios este mes</small>
                            </div>
                            <span class="badge bg-info rounded-pill">$1.1M</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>GHI-321</strong> - Hino 500<br>
                                <small class="text-muted">4 servicios este mes</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">$920K</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>JKL-654</strong> - Freightliner<br>
                                <small class="text-muted">4 servicios este mes</small>
                            </div>
                            <span class="badge bg-success rounded-pill">$850K</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Registrar Servicio -->
<div class="modal fade" id="modalRegistrarServicio" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Servicio de Mantenimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehículo</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="1">ABC-123 - Chevrolet NPR</option>
                                <option value="2">XYZ-789 - Ford Cargo</option>
                                <option value="3">DEF-456 - Isuzu NQR</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha del Servicio</label>
                            <input type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipo de Mantenimiento</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="preventivo">Preventivo</option>
                                <option value="correctivo">Correctivo</option>
                                <option value="predictivo">Predictivo</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Categoría</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="motor">Motor</option>
                                <option value="frenos">Frenos</option>
                                <option value="suspension">Suspensión</option>
                                <option value="electrico">Eléctrico</option>
                                <option value="otros">Otros</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kilometraje</label>
                            <input type="number" class="form-control" placeholder="Ej: 45000" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción del Servicio</label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Taller/Proveedor</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Costo Total</label>
                            <input type="number" class="form-control" placeholder="Ej: 250000" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Repuestos Utilizados</label>
                        <textarea class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Técnico Responsable</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Factura/Recibo (PDF)</label>
                        <input type="file" class="form-control" accept=".pdf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Registrar Servicio</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Servicio -->
<div class="modal fade" id="modalVerServicio" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Fecha del Servicio:</strong>
                        <p>20/11/2024</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Vehículo:</strong>
                        <p>ABC-123 - Chevrolet NPR 2020</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Tipo:</strong>
                        <p><span class="badge bg-success">Preventivo</span></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Categoría:</strong>
                        <p><span class="badge bg-secondary">Motor</span></p>
                    </div>
                    <div class="col-md-4">
                        <strong>Kilometraje:</strong>
                        <p>45,230 km</p>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <p>Cambio de aceite y filtros completo. Incluye aceite sintético 15W-40, filtro de aceite, filtro de aire y filtro de combustible.</p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Taller/Proveedor:</strong>
                        <p>Taller El Experto</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Costo Total:</strong>
                        <p class="text-success fs-5"><strong>$250,000</strong></p>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Repuestos Utilizados:</strong>
                    <ul>
                        <li>Aceite sintético 15W-40 (5 galones) - $120,000</li>
                        <li>Filtro de aceite - $35,000</li>
                        <li>Filtro de aire - $45,000</li>
                        <li>Filtro de combustible - $30,000</li>
                        <li>Mano de obra - $20,000</li>
                    </ul>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Técnico Responsable:</strong>
                        <p>José Martínez</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Registrado por:</strong>
                        <p>Admin User - 20/11/2024 15:30</p>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Observaciones:</strong>
                    <p>Servicio realizado sin novedades. Todos los niveles de líquidos verificados y completados. Próximo servicio recomendado en 10,000 km o 6 meses.</p>
                </div>
                <hr>
                <div>
                    <strong>Documentos Adjuntos:</strong>
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-file-pdf me-2"></i>Factura_20241120.pdf
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Descargar Reporte
                </button>
            </div>
        </div>
    </div>
</div>
@endsection