<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnos Obligatorios - Operadora</title>
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
        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background: #9c27b0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background: #7b1fa2;
        }
        .turnos-table {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #9c27b0;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.programado {
            background: #2196F3;
            color: white;
        }
        .badge.cumplido {
            background: #4CAF50;
            color: white;
        }
        .badge.incumplido {
            background: #f44336;
            color: white;
        }
        .badge.justificado {
            background: #FF9800;
            color: white;
        }
        .badge.cancelado {
            background: #9E9E9E;
            color: white;
        }
        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .pagination a, .pagination span {
            padding: 8px 12px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }
        .pagination .active {
            background: #9c27b0;
            color: white;
            border-color: #9c27b0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Turnos Obligatorios - Taxi Express Pamplona</h1>
        <div class="user-info">
            <span>Bienvenida, <?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-logout">Cerrar Sesión</button>
            </form>
        </div>
    </div>

    <div class="container">
        <a href="<?php echo e(route('operadora.dashboard')); ?>" class="btn-back">← Volver al Dashboard</a>

        <div class="turnos-table">
            <h2 style="margin-bottom: 20px;">Turnos Obligatorios Programados</h2>
            
            <?php if($turnos->count() > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Vehículo</th>
                            <th>Conductor</th>
                            <th>Estado</th>
                            <th>Asignado Por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $turnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($turno->fecha_turno->format('d/m/Y')); ?></td>
                                <td>
                                    <strong><?php echo e($turno->vehiculo->placa ?? 'N/A'); ?></strong><br>
                                    <small>Móvil <?php echo e($turno->vehiculo->numero_interno ?? 'N/A'); ?></small>
                                </td>
                                <td>
                                    <?php echo e($turno->conductor->primer_nombre ?? 'N/A'); ?> 
                                    <?php echo e($turno->conductor->primer_apellido ?? ''); ?>

                                </td>
                                <td>
                                    <span class="badge <?php echo e($turno->estado); ?>">
                                        <?php echo e(ucfirst($turno->estado)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($turno->asignadoPor->nombre ?? 'Sistema'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="pagination">
                    <?php echo e($turnos->links()); ?>

                </div>
            <?php else: ?>
                <p style="text-align: center; padding: 40px;">No hay turnos obligatorios programados.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\operadora\turnos-obligatorios.blade.php ENDPATH**/ ?>