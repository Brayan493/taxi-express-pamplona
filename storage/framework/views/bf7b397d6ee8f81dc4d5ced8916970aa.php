<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Alertas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .navbar {
            background: linear-gradient(135deg, #00695c, #00bfa5);
            color: white;
            padding: 15px 30px;
        }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background: #00695c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .back-link:hover { background: #004d40; }
        .alerta-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .alerta-card.alta { border-left: 5px solid #f44336; }
        .alerta-card.critica { border-left: 5px solid #d32f2f; }
        .alerta-card.media { border-left: 5px solid #ff9800; }
        .alerta-card.baja { border-left: 5px solid #4caf50; }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.resuelta { background: #d4edda; color: #155724; }
        .badge.pendiente { background: #f8d7da; color: #721c24; }
        .badge.critica { background: #d32f2f; color: white; }
        .badge.alta { background: #f44336; color: white; }
        .badge.media { background: #ff9800; color: white; }
        .badge.baja { background: #4caf50; color: white; }
        .alerta-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .alerta-header h3 { color: #333; }
        .info-row { margin: 8px 0; color: #555; }
        .info-row strong { color: #00695c; }
        .empty-state {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 10px;
            color: #666;
        }
        .empty-state .icon { font-size: 60px; margin-bottom: 15px; }
        .pagination-container { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>⚠️ Mis Alertas</h1>
    </div>

    <div class="container">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-link">← Volver al Dashboard</a>

        <?php $__empty_1 = true; $__currentLoopData = $alertas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alerta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="alerta-card <?php echo e(strtolower($alerta->prioridad)); ?>">
                <div class="alerta-header">
                    <h3><?php echo e($alerta->titulo); ?></h3>
                    <span class="badge <?php echo e(strtolower($alerta->prioridad)); ?>">
                        <?php echo e(ucfirst($alerta->prioridad)); ?>

                    </span>
                </div>
                
                <div class="info-row">
                    <strong>Tipo:</strong> <?php echo e(ucfirst(str_replace('_', ' ', $alerta->tipo_alerta))); ?>

                </div>
                
                <div class="info-row">
                    <strong>Descripción:</strong> <?php echo e($alerta->descripcion); ?>

                </div>
                
                <?php if($alerta->fecha_vencimiento): ?>
                    <div class="info-row">
                        <strong>Fecha vencimiento:</strong> <?php echo e(\Carbon\Carbon::parse($alerta->fecha_vencimiento)->format('d/m/Y')); ?>

                    </div>
                <?php endif; ?>
                
                <div class="info-row">
                    <strong>Estado:</strong> 
                    <span class="badge <?php echo e($alerta->resuelta ? 'resuelta' : 'pendiente'); ?>">
                        <?php echo e($alerta->resuelta ? 'Resuelta' : 'Pendiente'); ?>

                    </span>
                </div>
                
                <div class="info-row" style="margin-top: 15px; color: #888; font-size: 13px;">
                    📅 Fecha alerta: <?php echo e(\Carbon\Carbon::parse($alerta->fecha_alerta)->format('d/m/Y H:i')); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <div class="icon">✅</div>
                <h3>¡No tienes alertas!</h3>
                <p>No hay alertas registradas para tu perfil.</p>
            </div>
        <?php endif; ?>

        <div class="pagination-container">
            <?php echo e($alertas->links()); ?>

        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\admin\alertas.blade.php ENDPATH**/ ?>