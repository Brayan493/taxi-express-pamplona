<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Turnos</title>
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
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #9c27b0;
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
            background: #9c27b0;
            color: white;
        }
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.si {
            background: #d4edda;
            color: #155724;
        }
        .badge.no {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Control de Turnos</h1>
    </div>

    <div class="container">
        <a href="<?php echo e(route('operadora.dashboard')); ?>" class="back-link">← Volver al Dashboard</a>

        <table>
            <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Conductor</th>
                    <th>Franja</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Hora Llamado</th>
                    <th>Respondió</th>
                    <th>En Servicio</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $controles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $control): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($control->turno->vehiculo->placa); ?></td>
                        <td><?php echo e($control->turno->conductor->primer_nombre); ?> <?php echo e($control->turno->conductor->primer_apellido); ?></td>
                        <td><?php echo e($control->nombre_franja); ?></td>
                        <td><?php echo e($control->hora_inicio); ?></td>
                        <td><?php echo e($control->hora_fin); ?></td>
                        <td><?php echo e($control->hora_llamado); ?></td>
                        <td>
                            <span class="badge <?php echo e($control->respondio ? 'si' : 'no'); ?>">
                                <?php echo e($control->respondio ? 'Sí' : 'No'); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge <?php echo e($control->en_servicio ? 'si' : 'no'); ?>">
                                <?php echo e($control->en_servicio ? 'Sí' : 'No'); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">No hay controles de turno registrados hoy</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\operadora\control-turnos.blade.php ENDPATH**/ ?>