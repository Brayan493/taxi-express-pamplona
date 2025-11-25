<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .navbar {
            background: linear-gradient(135deg, #00bcd4, #009688);
            color: white;
            padding: 15px 30px;
        }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #00bcd4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .vehiculo-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .vehiculo-info h3 { color: #00bcd4; margin-bottom: 10px; }
        .badge {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }
        .badge.activo { background: #d4edda; color: #155724; }
        .badge.inactivo { background: #f8d7da; color: #721c24; }
        .badge.mantenimiento { background: #fff3cd; color: #856404; }
        .specs { display: flex; gap: 20px; margin-top: 10px; flex-wrap: wrap; }
        .spec { background: #f5f5f5; padding: 5px 10px; border-radius: 5px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🚐 Vehículos</h1>
    </div>

    <div class="container">
        <a href="<?php echo e(route('conductor.dashboard')); ?>" class="back-link">← Volver al Dashboard</a>

        <?php $__empty_1 = true; $__currentLoopData = $vehiculos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehiculo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="vehiculo-card">
                <div class="vehiculo-info">
                    <h3><?php echo e($vehiculo->placa); ?></h3>
                    <p><strong><?php echo e($vehiculo->marca); ?> <?php echo e($vehiculo->linea); ?></strong> - <?php echo e($vehiculo->modelo); ?></p>
                    <p><strong>Propietario:</strong> <?php echo e($vehiculo->propietario->razon_social ?? 'N/A'); ?></p>
                    <div class="specs">
                        <span class="spec">🎨 <?php echo e($vehiculo->color); ?></span>
                        <span class="spec">👥 <?php echo e($vehiculo->capacidad_pasajeros); ?> pasajeros</span>
                        <span class="spec">⛽ <?php echo e(ucfirst($vehiculo->tipo_combustible)); ?></span>
                        <span class="spec">📏 <?php echo e(number_format($vehiculo->kilometraje_actual)); ?> km</span>
                    </div>
                </div>
                <span class="badge <?php echo e($vehiculo->estado); ?>">
                    <?php echo e(ucfirst($vehiculo->estado)); ?>

                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>No hay vehículos registrados.</p>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <?php echo e($vehiculos->links()); ?>

        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\conductor\vehiculos.blade.php ENDPATH**/ ?>