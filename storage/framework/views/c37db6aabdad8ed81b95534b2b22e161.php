<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administrador</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        
        .navbar {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 { font-size: 22px; }
        .btn-logout {
            background: white;
            color: #ff6b35;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-logout:hover { background: #f0f0f0; }
        
        .container { max-width: 1400px; margin: 30px auto; padding: 0 20px; }
        
        .menu-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .menu-nav a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .menu-nav a:hover {
            background: linear-gradient(135deg, #ff5722, #f57c00);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255,107,53,0.4);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #ff6b35;
        }
        .stat-card h3 { color: #666; font-size: 14px; margin-bottom: 10px; }
        .stat-card .number { font-size: 36px; font-weight: bold; color: #ff6b35; }
        .stat-card.alertas { border-left-color: #e53e3e; }
        .stat-card.alertas .number { color: #e53e3e; }
        .stat-card.success { border-left-color: #38a169; }
        .stat-card.success .number { color: #38a169; }
        .stat-card.warning { border-left-color: #dd6b20; }
        .stat-card.warning .number { color: #dd6b20; }
        
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
            gap: 20px;
        }
        
        .section {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .section h2 {
            color: #ff6b35;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }
        .section h2 a {
            font-size: 13px;
            color: #ff6b35;
            text-decoration: none;
        }
        .section h2 a:hover { text-decoration: underline; }
        
        .list-item {
            padding: 15px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border-radius: 0 8px 8px 0;
            border-left: 4px solid #ff6b35;
        }
        .list-item:hover { background: #fff5f0; }
        .list-item strong { color: #333; }
        .list-item .meta { font-size: 13px; color: #666; margin-top: 5px; }
        
        .alert-item {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 0 8px 8px 0;
        }
        .alert-item.critica { border-left: 4px solid #e53e3e; background: #fff5f5; }
        .alert-item.alta { border-left: 4px solid #dd6b20; background: #fffaf0; }
        .alert-item.media { border-left: 4px solid #d69e2e; background: #fffff0; }
        .alert-item.baja { border-left: 4px solid #38a169; background: #f0fff4; }
        .alert-item strong { color: #333; display: block; margin-bottom: 5px; }
        .alert-item p { font-size: 14px; color: #555; margin: 5px 0; }
        .alert-item small { font-size: 12px; color: #888; }
        
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }
        .badge.critica { background: #e53e3e; color: white; }
        .badge.alta { background: #dd6b20; color: white; }
        .badge.media { background: #d69e2e; color: #333; }
        .badge.baja { background: #38a169; color: white; }
        .badge.success { background: #38a169; color: white; }
        .badge.warning { background: #d69e2e; color: #333; }
        .badge.danger { background: #e53e3e; color: white; }
        .badge.info { background: #ff6b35; color: white; }
        .badge.secondary { background: #718096; color: white; }
        
        table { width: 100%; border-collapse: collapse; }
        table th {
            text-align: left;
            padding: 12px;
            background: #ff6b35;
            color: white;
            font-size: 13px;
        }
        table th:first-child { border-radius: 8px 0 0 0; }
        table th:last-child { border-radius: 0 8px 0 0; }
        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }
        table tr:hover { background: #fff5f0; }
        
        .empty-state {
            text-align: center;
            padding: 30px;
            color: #888;
        }
        .empty-state .icon { font-size: 40px; margin-bottom: 10px; }
        
        .alert-box {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-box.success { background: #c6f6d5; color: #22543d; border-left: 4px solid #38a169; }
        .alert-box.error { background: #fed7d7; color: #742a2a; border-left: 4px solid #e53e3e; }
        
        @media (max-width: 768px) {
            .content-grid { grid-template-columns: 1fr; }
            .navbar { flex-direction: column; gap: 10px; }
            .menu-nav { justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🚖 Panel de Administrador - Taxi Express Pamplona</h1>
        <div class="user-info">
            <span>Bienvenido, <?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline; margin-left: 15px;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert-box success">✅ <?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert-box error">⚠️ <?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="menu-nav">
            <a href="<?php echo e(route('admin.vehiculos')); ?>">🚐 Vehículos</a>
            <a href="<?php echo e(route('admin.conductores')); ?>">👥 Conductores</a>
            <a href="<?php echo e(route('admin.propietarios')); ?>">🏢 Propietarios</a>
            <a href="<?php echo e(route('admin.alertas')); ?>">⚠️ Alertas</a>
            <a href="<?php echo e(route('admin.solicitudes-cambio-ruta')); ?>">📝 Solicitudes Ruta</a>
            <a href="<?php echo e(route('admin.tarifas-destino')); ?>">💰 Tarifas</a>
            <a href="<?php echo e(route('admin.mantenimiento-general')); ?>">🔧 Mantenimientos</a>
        </div>

        <div class="stats-grid">
            <div class="stat-card success">
                <h3>🚐 Vehículos Activos</h3>
                <div class="number"><?php echo e($vehiculosActivos ?? 0); ?></div>
            </div>
            <div class="stat-card">
                <h3>👥 Conductores Activos</h3>
                <div class="number"><?php echo e($conductoresActivos ?? 0); ?></div>
            </div>
            <div class="stat-card warning">
                <h3>📅 Turnos Hoy</h3>
                <div class="number"><?php echo e($turnosHoy ?? 0); ?></div>
            </div>
            <div class="stat-card alertas">
                <h3>⚠️ Alertas Pendientes</h3>
                <div class="number"><?php echo e($alertasPendientes ?? 0); ?></div>
            </div>
        </div>

        <div class="content-grid">
            <div class="section">
                <h2>⚠️ Alertas Recientes <a href="<?php echo e(route('admin.alertas')); ?>">Ver todas →</a></h2>
                <?php $__empty_1 = true; $__currentLoopData = $alertasRecientes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="alert-item <?php echo e(strtolower($alerta->prioridad)); ?>">
                        <strong><?php echo e($alerta->titulo); ?></strong>
                        <span class="badge <?php echo e(strtolower($alerta->prioridad)); ?>"><?php echo e(ucfirst($alerta->prioridad)); ?></span>
                        <p><?php echo e(Str::limit($alerta->descripcion, 80)); ?></p>
                        <small>
                            <?php if($alerta->vehiculo): ?>🚐 <?php echo e($alerta->vehiculo->placa); ?><?php endif; ?>
                            <?php if($alerta->conductor): ?> | 👤 <?php echo e($alerta->conductor->primer_nombre); ?><?php endif; ?>
                            <?php if($alerta->fecha_vencimiento): ?> | 📅 <?php echo e(\Carbon\Carbon::parse($alerta->fecha_vencimiento)->format('d/m/Y')); ?><?php endif; ?>
                        </small>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state"><div class="icon">✅</div><p>No hay alertas pendientes</p></div>
                <?php endif; ?>
            </div>

            <div class="section">
                <h2>📝 Solicitudes Pendientes <a href="<?php echo e(route('admin.solicitudes-cambio-ruta')); ?>">Ver todas →</a></h2>
                <?php $__empty_1 = true; $__currentLoopData = $solicitudesRecientes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="list-item">
                        <strong><?php echo e($solicitud->conductor->primer_nombre ?? 'N/A'); ?> <?php echo e($solicitud->conductor->primer_apellido ?? ''); ?></strong>
                        <span class="badge <?php echo e($solicitud->autorizado_por ? 'success' : 'warning'); ?>"><?php echo e($solicitud->autorizado_por ? 'Autorizado' : 'Pendiente'); ?></span>
                        <div class="meta">🚐 <?php echo e($solicitud->vehiculo->placa ?? 'N/A'); ?> | 📍 <?php echo e($solicitud->tarifaDestino->nombre_destino ?? $solicitud->direccion_destino ?? 'N/A'); ?></div>
                        <div class="meta">📅 <?php echo e(\Carbon\Carbon::parse($solicitud->fecha_viaje_programada)->format('d/m/Y H:i')); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty-state"><div class="icon">📝</div><p>No hay solicitudes pendientes</p></div>
                <?php endif; ?>
            </div>

            <div class="section">
                <h2>👥 Conductores Recientes <a href="<?php echo e(route('admin.conductores')); ?>">Ver todos →</a></h2>
                <table>
                    <thead><tr><th>Nombre</th><th>Documento</th><th>Licencia</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $conductoresRecientes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conductor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($conductor->primer_nombre); ?> <?php echo e($conductor->primer_apellido); ?></strong></td>
                                <td><?php echo e($conductor->tipo_documento); ?>: <?php echo e($conductor->numero_documento); ?></td>
                                <td><?php echo e($conductor->categoria_licencia); ?></td>
                                <td><span class="badge <?php echo e($conductor->estado == 'activo' ? 'success' : 'secondary'); ?>"><?php echo e(ucfirst($conductor->estado)); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="empty-state">No hay conductores</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>🚐 Vehículos Recientes <a href="<?php echo e(route('admin.vehiculos')); ?>">Ver todos →</a></h2>
                <table>
                    <thead><tr><th>Placa</th><th>Móvil</th><th>Marca/Modelo</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $vehiculosRecientes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($vehiculo->placa); ?></strong></td>
                                <td><span class="badge info"><?php echo e($vehiculo->numero_interno); ?></span></td>
                                <td><?php echo e($vehiculo->marca); ?> <?php echo e($vehiculo->modelo); ?></td>
                                <td><span class="badge <?php echo e($vehiculo->estado == 'activo' ? 'success' : ($vehiculo->estado == 'en mantenimiento' ? 'warning' : 'secondary')); ?>"><?php echo e(ucfirst($vehiculo->estado)); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="empty-state">No hay vehículos</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>💰 Tarifas Destinos <a href="<?php echo e(route('admin.tarifas-destino')); ?>">Ver todas →</a></h2>
                <table>
                    <thead><tr><th>Destino</th><th>Ciudad</th><th>Tarifa</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $tarifasDestino ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tarifa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($tarifa->nombre_destino); ?></strong></td>
                                <td><?php echo e($tarifa->ciudad); ?></td>
                                <td><strong style="color: #38a169;">$<?php echo e(number_format($tarifa->tarifa_base, 0, ',', '.')); ?></strong></td>
                                <td><span class="badge <?php echo e($tarifa->activa ? 'success' : 'secondary'); ?>"><?php echo e($tarifa->activa ? 'Activa' : 'Inactiva'); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="empty-state">No hay tarifas</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>🏢 Propietarios <a href="<?php echo e(route('admin.propietarios')); ?>">Ver todos →</a></h2>
                <table>
                    <thead><tr><th>Razón Social</th><th>NIT</th><th>Representante</th><th>Estado</th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $propietariosRecientes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propietario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($propietario->razon_social); ?></strong></td>
                                <td><?php echo e($propietario->nit); ?></td>
                                <td><?php echo e($propietario->representante_legal); ?></td>
                                <td><span class="badge <?php echo e($propietario->activo ? 'success' : 'secondary'); ?>"><?php echo e($propietario->activo ? 'Activo' : 'Inactivo'); ?></span></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="empty-state">No hay propietarios</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>