<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos - Administrador</title>
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
            background: linear-gradient(135deg, #ff0000, #ffaa00);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #0066cc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #333;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .estado {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .estado.activo {
            background: #d4edda;
            color: #155724;
        }
        .estado.inactivo {
            background: #f8d7da;
            color: #721c24;
        }
        .estado.mantenimiento {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Gestión de Vehículos</h1>
        <span><?php echo e(Auth::user()->nombre_completo); ?></span>
    </div>

    <div class="container">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>N° Interno</th>
                    <th>Marca/Modelo</th>
                    <th>Año</th>
                    <th>Propietario</th>
                    <th>SOAT</th>
                    <th>Tecnomecánica</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $vehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><strong><?php echo e($vehiculo->placa); ?></strong></td>
                        <td><?php echo e($vehiculo->numero_interno); ?></td>
                        <td><?php echo e($vehiculo->marca); ?> <?php echo e($vehiculo->modelo); ?></td>
                        <td><?php echo e($vehiculo->anio); ?></td>
                        <td><?php echo e($vehiculo->propietario->razon_social ?? 'N/A'); ?></td>
                        <td><?php echo e($vehiculo->fecha_soat ? $vehiculo->fecha_soat->format('d/m/Y') : 'N/A'); ?></td>
                        <td><?php echo e($vehiculo->fecha_tecnicomecanica ? $vehiculo->fecha_tecnicomecanica->format('d/m/Y') : 'N/A'); ?></td>
                        <td>
                            <span class="estado <?php echo e(str_replace(' ', '', strtolower($vehiculo->estado))); ?>">
                                <?php echo e(ucfirst($vehiculo->estado)); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No hay vehículos registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\admin\vehiculos.blade.php ENDPATH**/ ?>