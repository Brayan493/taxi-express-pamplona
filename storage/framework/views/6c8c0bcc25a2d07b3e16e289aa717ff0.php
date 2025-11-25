<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cumplimiento - Operadora</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .navbar { background: linear-gradient(135deg, #9c27b0, #e91e63); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { font-size: 24px; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .form-container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #9c27b0; }
        .checkbox-group { display: flex; align-items: center; gap: 10px; }
        .checkbox-group input[type="checkbox"] { width: auto; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; }
        .btn-primary { background: #9c27b0; color: white; }
        .btn-primary:hover { background: #7b1fa2; }
        .btn-secondary { background: #666; color: white; }
        .btn-secondary:hover { background: #555; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-delete:hover { background: #c82333; }
        .error-message { padding: 15px; background: #f8d7da; color: #721c24; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb; }
        .error-list { list-style: none; margin-top: 10px; }
        .error-list li { margin-bottom: 5px; }
        .info-card { background: #f0f0f0; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .info-card p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Editar Registro de Cumplimiento</h1>
    </div>

    <div class="container">
        <?php if(session('error')): ?>
            <div class="error-message">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="error-message">
                <strong>Por favor corrija los siguientes errores:</strong>
                <ul class="error-list">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>• <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="info-card">
            <h4>Turno Asociado</h4>
            <p><strong>ID Control:</strong> <?php echo e($control->id_control); ?></p>
            <p><strong>Fecha:</strong> <?php echo e(\Carbon\Carbon::parse($control->fecha_turno)->format('d/m/Y')); ?></p>
            <p><strong>Vehículo:</strong> Móvil <?php echo e($control->numero_interno); ?> (<?php echo e($control->placa); ?>)</p>
            <p><strong>Conductor:</strong> <?php echo e($control->primer_nombre); ?> <?php echo e($control->primer_apellido); ?></p>
        </div>

        <div class="form-container">
            <form action="<?php echo e(route('operadora.cumplimiento-turnos', $control->id_control)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> 
                
                <div class="form-group">
                    <label for="nombre_franja">Nombre de la Franja</label>
                    <input type="text" name="nombre_franja" id="nombre_franja" required 
                           value="<?php echo e(old('nombre_franja', $control->nombre_franja)); ?>">
                </div>

                <div class="form-group" style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <label for="hora_inicio">Hora Inicio (Franja)</label>
                        <input type="time" name="hora_inicio" id="hora_inicio" required 
                               value="<?php echo e(old('hora_inicio', substr($control->hora_inicio, 0, 5))); ?>">
                    </div>
                    <div style="flex: 1;">
                        <label for="hora_fin">Hora Fin (Franja)</label>
                        <input type="time" name="hora_fin" id="hora_fin" required 
                               value="<?php echo e(old('hora_fin', substr($control->hora_fin, 0, 5))); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Cruza Medianoche</label>
                    <div class="checkbox-group">
                        <input type="checkbox" name="cruza_medianoche" id="cruza_medianoche" value="1" 
                               <?php echo e(old('cruza_medianoche', $control->cruza_medianoche) ? 'checked' : ''); ?>>
                        <label for="cruza_medianoche">La franja horaria cruza la medianoche (ej. 22:00 a 06:00)</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hora_llamado">Hora del Llamado</label>
                    <input type="time" name="hora_llamado" id="hora_llamado" required 
                           value="<?php echo e(old('hora_llamado', substr($control->hora_llamado, 0, 5))); ?>">
                </div>

                <div class="form-group">
                    <label>Resultado del Llamado</label>
                    <div class="checkbox-group">
                        <input type="checkbox" name="respondio" id="respondio" value="1" 
                               <?php echo e(old('respondio', $control->respondio) ? 'checked' : ''); ?>>
                        <label for="respondio">¿Respondió el Conductor?</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-group">
                        <input type="checkbox" name="en_servicio" id="en_servicio" value="1" 
                               <?php echo e(old('en_servicio', $control->en_servicio) ? 'checked' : ''); ?>>
                        <label for="en_servicio">¿Estaba En Servicio / Disponible?</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar Registro</button>
                    <a href="<?php echo e(route('operadora.cumplimiento-turnos')); ?>" class="btn btn-secondary">Volver</a>
                </div>
            </form>
            
            <form action="<?php echo e(route('operadora.cumplimiento-turnos', $control->id_control)); ?>" method="POST" style="margin-top: 15px;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar este registro de control?')">
                    Eliminar Registro
                </button>
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\operadora\cumplimiento-turnos\editar.blade.php ENDPATH**/ ?>