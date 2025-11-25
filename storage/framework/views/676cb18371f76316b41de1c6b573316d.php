<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos - Operadora</title>
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
        .vehiculos-table {
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
        .badge.activo {
            background: #4CAF50;
            color: white;
        }
        .badge.inactivo {
            background: #f44336;
            color: white;
        }
        .badge.mantenimiento {
            background: #FF9800;
            color: white;
        }
        .badge.disponible {
            background: #2196F3;
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
        <h1>Vehículos - Taxi Express Pamplona</h1>
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

        <div class="vehiculos-table">
            <h2 style="margin-bottom: 20px;">Listado de Vehículos</h2>
            
            <?php if($vehiculos->count() > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Móvil</th>
                            <th>Placa</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Color</th>
                            <th>Propietario</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($vehiculo->numero_interno); ?></strong></td>
                                <td><strong><?php echo e($vehiculo->placa); ?></strong></td>
                                <td><?php echo e($vehiculo->marca); ?></td>
                                <td><?php echo e($vehiculo->modelo); ?></td>
                                <td><?php echo e($vehiculo->anio); ?></td>
                                <td><?php echo e($vehiculo->color); ?></td>
                                <td><?php echo e($vehiculo->propietario->razon_social ?? 'N/A'); ?></td>
                                <td>
                                    <span class="badge <?php echo e(str_replace(' ', '-', strtolower($vehiculo->estado))); ?>">
                                        <?php echo e(ucfirst($vehiculo->estado)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <div class="pagination">
                    <?php echo e($vehiculos->links()); ?>

                </div>
            <?php else: ?>
                <p style="text-align: center; padding: 40px;">No hay vehículos registrados.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\operadora\vehiculos.blade.php ENDPATH**/ ?>